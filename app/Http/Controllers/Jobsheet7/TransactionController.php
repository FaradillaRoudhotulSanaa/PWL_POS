<?php

namespace App\Http\Controllers\Jobsheet7;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use App\Models\detailPenjualanModel;
use App\Models\PenjualanModel;
use App\Models\UserModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Transaksi',
            'list' => ['Home', 'Transaksi'],
        ];

        $page = (object)[
            'title' => 'Daftar transaksi barang yang terdaftar dalam sistem',
        ];

        $activeMenu = 'penjualan';

        $user = UserModel::all();

        return view('layouts.transaksi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user,'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $transaksi = PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_tanggal')->with(['detail.barang', 'user']);

        if ($request->user_id) {
            $transaksi->where('user_id', $request->user_id);
        }

        return DataTables::of($transaksi)->addIndexColumn()->addColumn('aksi', function ($transaksi) {
                $btn = '<a href="' . url('/transaksi/show/' . $transaksi->penjualan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/transaksi/' . $transaksi->penjualan_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/transaksi/' . $transaksi->penjualan_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })->rawColumns(['aksi'])
            ->make(true);
    }

    public function store(Request $request){
        $request->validate([
            'barang_id' => 'required|integer',
            'user_id' => 'required|integer',
            'pembeli' => 'required|max:100',
            'penjualan_tanggal' => 'required|date',
            'harga' => 'required|integer',
            'jumlah' => 'required|integer'
        ]);

        $status = PenjualanModel::create([
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_tanggal' => $request->penjualan_tanggal,
        ]);

        if ($status) {
            detailPenjualanModel::create([
                'penjualan_id' => $status->penjualan_id,
                'barang_id' => $request->barang_id,
                'jumlah' => $request->jumlah,
                'harga' => $request->harga,
            ]);
        }

        return redirect('/transaksi')->with('success','Transaksi Berhasil');
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Transaksi',
            'list' => ['Home', 'Transaksi', 'Tambah'],
        ];

        $page = (object)[
            'title' => 'Tambah transaksi',
        ];

        $user = UserModel::all();
        $barang = BarangModel::all();
        $activeMenu = 'penjualan';

        return view('layouts.transaksi.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'barang' => $barang ,'activeMenu' => $activeMenu]);
    }
    
    public function show(string $id){
        $transaksi = PenjualanModel::with(['detail.barang','user'])->find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Transaksi',
            'list' => ['Home', 'Transaksi', 'Detail'],
        ];

        $page = (object)[
            'title' => 'Detail transaksi barang',
        ];

        $activeMenu = 'penjualan';

        return view('layouts.transaksi.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'transaksi' => $transaksi,'activeMenu' => $activeMenu]);
    }
    
    public function edit(string $id){
        $transaksi = PenjualanModel::with('detail.barang','user')->where('penjualan_id',$id)->first();
        $user = UserModel::all();
        $barang = BarangModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit Transaksi',
            'list' => ['Home', 'Transaksi', 'Edit'],
        ];

        $page = (object)[
            'title' => 'Edit transaksi',
        ];

        $activeMenu = 'penjualan';

        return view('layouts.transaksi.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'transaksi' => $transaksi, 'user' => $user ,'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id){
        $request->validate([
            'barang_id' => 'required|integer',
            'user_id' => 'required|integer',
            'pembeli' => 'required|max:100',
            'penjualan_tanggal' => 'required|date',
            'harga' => 'required|integer',
            'jumlah' => 'required|integer'
        ]);

        $data = PenjualanModel::find($id);

        $status = $data->update([
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_tanggal' => date("Y-m-d H:i:s",strtotime($request->penjualan_tanggal)),
        ]);

        if ($status) {
            detailPenjualanModel::find($data->penjualan_id)->update([
                'barang_id' => $request->barang_id,
                'jumlah' => $request->jumlah,
                'harga' => $request->harga,
            ]);
        }

        return redirect('/transaksi')->with('success', 'Transaksi berhasil diubah');
    }

    public function destroy(string $id){
        $check = PenjualanModel::find($id);
        if (!$check){
            return redirect('/transaksi')->with('error', 'Data transaksi barang tidak ditemukan');
        }

        try{
            detailPenjualanModel::where('penjualan_id', $id)->delete();
            PenjualanModel::destroy($id);
            return redirect('/transaksi')->with('success', 'Data transaksi barang berhasil dihapus');
        }catch(QueryException $e){
            return redirect('/transaksi')->with('error', 'Data transaksi barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
