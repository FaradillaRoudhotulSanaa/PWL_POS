<?php

namespace App\Http\Controllers\Jobsheet7;

use App\Http\Controllers\Controller;
use App\Models\LevelModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level'],
        ];

        $page = (object)[
            'title' => 'Daftar Level',
        ];

        $activeMenu = 'level';

        return view('layouts.level.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $level = LevelModel::select('level_id', 'level_kode', 'level_nama');

        return DataTables::of($level)->addIndexColumn()->addColumn('aksi', function ($level) {
                $btn = '<a href="' . url('/level/show/' . $level->level_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/level/' . $level->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/level/' . $level->level_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })->rawColumns(['aksi'])
            ->make(true);
    }

    public function store(Request $request){
        $request->validate([
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:100',
        ]);

        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level')->with('success','Data level berhasil disimpan');
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah'],
        ];

        $page = (object)[
            'title' => 'Tambah level baru',
        ];

        $activeMenu = 'level';

        return view('layouts.level.create', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu]);
    }
    
    public function show(string $id){
        $level = LevelModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Level',
            'list' => ['Home', 'Level', 'Detail'],
        ];

        $page = (object)[
            'title' => 'Detail level',
        ];

        $activeMenu = 'level';

        return view('layouts.level.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level,'activeMenu' => $activeMenu]);
    }
    
    public function edit(string $id){
        $level = LevelModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Level',
            'list' => ['Home', 'Level', 'Edit'],
        ];

        $page = (object)[
            'title' => 'Edit level',
        ];

        $activeMenu = 'level';

        return view('layouts.level.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id){
        $request->validate([
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode,'.$id.',level_id',
            'level_nama' => 'required|string|max:100',
        ]);

        LevelModel::find($id)->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Data level berhasil diubah');
    }

    public function destroy(string $id){
        $check = LevelModel::find($id);
        if (!$check){
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }

        try{
            LevelModel::destroy($id);
            return redirect('/level')->with('success', 'Data level berhasil dihapus');
        }catch(QueryException $e){
            return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
