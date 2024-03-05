<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    public function index() {
        // tambah data user dengan Eloquent Model 
        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345')
        // ];
        // UserModel::create($data); // tambahkan data ke tabel m_user  
        
        // $data = [
        //     'nama' => 'Pelanggan Pertama',
        // ];
        // UserModel::where('username', 'customer-1')->update($data);

        // coba akses model UserModel

        // $user = UserModel::all();
        // return view('user', ['data' => $user]);

        // $user = UserModel::find(1);  
        // return view('user', ['data' => $user]);

        // $user = UserModel::where('level_id', 1)->first();
        // return view('user', ['data' => $user]);

        // $user = UserModel::firstWhere('level_id', 1);
        // return view('user', ['data' => $user]);

        $user = UserModel::findOr(3, ['username', 'nama'], function() {
            abort(404);
        });
        return view('user', ['data' => $user]);
    }
}
