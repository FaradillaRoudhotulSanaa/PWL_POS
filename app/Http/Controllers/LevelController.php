<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller {
    public function index() {
        $data = DB::select('select * from m_level');
        return view('level', ['data' => $data]);
    }

    public function store(Request $request){
        $request->validate([
            'level_kode' => 'required|unique:posts',
            'level_nama' => 'required|max:255',
        ]);

        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/')->with('Success','Data Berhasil Ditambahkan!');
    }
}
