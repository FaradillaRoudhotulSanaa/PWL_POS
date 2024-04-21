<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Nette\Utils\Validators;

class AuthController extends Controller {
    public function index() {
        // mengambil data user, disimpan di $user
        $user = Auth::user();

        // jika user udah ada 
        if ($user) {
            // jika level user admin 
            if ($user->level_id == '1') {
                return redirect()->intended('admin');
            } 
            // jika level user manager 
            else if ($user->level == '2') {
                return redirect()->intended('manager');
            }
        }
        return view('login');
    }

    public function proses_login(Request $request) {
        // bikin validasi, username dan password wajib diisi 
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // ambil data req username dan password aja 
        $credential = $request->only('username', 'password');

        // cek username dan password sesuai data 
        if (Auth::attempt($credential)) {
            // kalo berhasil simpan data user di $user 
            $user = Auth::user();

            // jika level user admin maka ke halaman admin 
            if ($user->level_id == '1') {
                //dd($user->level_id);
                return redirect()->intended('admin');
            }

            // jika level usernya user maka ke halaman user 
            else if ($user->level_id == '2') {
                return redirect()->intended('manager');
            }
            // jika gada role ke halaman /
            return redirect()->intended('/'); 
        }

        // jika data ga valid maka balik ke halaman login, pastikan kirim pesan error kalo gagal 
        return redirect('login')
            ->withInput()
            ->withErrors(['login_gagal' => 'Pastikan kembali username dan password yang dimasukkan sudah benar']); 
    }

    public function register() {
        // tampilkan view register 
        return view('register');
    }

    // aksi form register 
    public function proses_register(Request $request) {
        // buat validasi untuk register, semua field wajib diisi, usernmae harus unik dan tidak duplicate 
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required|unique:m_user',
            'password' => 'required'
        ]);

        // kalo gagal balik ke halam register dan kirim pesan error 
        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        // kalo berhasil isi level dan hash password biar secure 
        $request['level_id'] = '2';
        $request['password'] = Hash::make($request->password);

        // masukkan semua data req ke table user 
        UserModel::create($request->all());
    }

    public function logout(Request $request) {
        // logout harus hapus session 
        $request->session()->flush();

        // jalankan fungsi logout di auth 
        Auth::logout();

        // kembali ke halaman login 
        return Redirect('login');
    }
}
