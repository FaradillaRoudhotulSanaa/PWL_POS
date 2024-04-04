<?php

namespace App\Http\Controllers\Jobsheet7;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use App\Models\StokModel;
use App\Models\UserModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Stok Barang',
            'list' => ['Home', 'Stok'],
        ];

        $page = (object)[
            'title' => 'Daftar stok barang yang terdaftar dalam sistem',
        ];

        $activeMenu = 'stok';

        $user = UserModel::all();
        $barang = BarangModel::all();

        return view('layouts.stok.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'barang' => $barang ,'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $stok = StokModel::select('stok_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')->with(['barang', 'user']);

        if ($request->barang_id) {
            $stok->where('barang_id', $request->kategori_id);
        }

        return DataTables::of($stok)->addIndexColumn()->addColumn('aksi', function ($stok) {
                $btn = '<a href="' . url('/stok/show/' . $stok->stok_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/stok/' . $stok->stok_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/stok/' . $stok->stok_id) . '">'
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
            'stok_jumlah' => 'required|integer',
        ]);

        StokModel::create([
            'barang_id' => $request->barang_id,
            'user_id' => $request->user_id,
            'stok_tanggal' => date('Y-m-d H:m:s'),
            'stok_jumlah' => $request->stok_jumlah,
        ]);

        return redirect('/stok')->with('success','Data stok berhasil disimpan');
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Stok Barang',
            'list' => ['Home', 'Stok', 'Tambah'],
        ];

        $page = (object)[
            'title' => 'Tambah stok barang',
        ];

        $user = UserModel::all();
        $barang = BarangModel::all();
        $activeMenu = 'stok';

        return view('layouts.stok.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'barang' => $barang ,'activeMenu' => $activeMenu]);
    }
    
    public function show(string $id){
        $stok = StokModel::with(['user','barang'])->find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Stok Barang',
            'list' => ['Home', 'Stok', 'Detail'],
        ];

        $page = (object)[
            'title' => 'Detail stok barang',
        ];

        $activeMenu = 'stok';

        return view('layouts.stok.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stok' => $stok,'activeMenu' => $activeMenu]);
    }
    
    public function edit(string $id){
        $stok = StokModel::find($id);
        $user = UserModel::all();
        $barang = BarangModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit Stok Barang',
            'list' => ['Home', 'Stok', 'Edit'],
        ];

        $page = (object)[
            'title' => 'Edit stok barang',
        ];

        $activeMenu = 'stok';

        return view('layouts.stok.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'stok' => $stok, 'user' => $user ,'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id){
        $request->validate([
            'stok_jumlah' => 'required|integer',
            'user_id' => 'required|integer',
            'barang_id' => 'required|integer',
        ]);

        StokModel::find($id)->update([
            'stok_jumlah' => $request->stok_jumlah,
            'barang_id' => $request->barang_id,
            'user_id' => $request->user_id,
        ]);

        return redirect('/stok')->with('success', 'Data stok barang berhasil diubah');
    }

    public function destroy(string $id){
        $check = StokModel::find($id);
        if (!$check){
            return redirect('/stok')->with('error', 'Data stok barang tidak ditemukan');
        }

        try{
            StokModel::destroy($id);
            return redirect('/stok')->with('success', 'Data stok barang berhasil dihapus');
        }catch(QueryException $e){
            return redirect('/stok')->with('error', 'Data stok barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
