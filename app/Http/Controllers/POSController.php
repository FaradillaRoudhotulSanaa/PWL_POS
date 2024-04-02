<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class POSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = UserModel::with('level')->get();
        return view('m_user.index', compact('data'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('m_user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'max 20',
            'level_id' => 'required',
            'username' => 'required',
            'nama' => 'required',
            'password' => 'required',
        ]);

        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make('$request->password'),
            'level_id' => $request->level_id
        ]);

        return redirect()->route('user.index')->with('success','Data Berhasil Ditambahkan!');
    }

    public function show(string $id)
    {
        $data = UserModel::where('user_id',$id)->with('level')->first();
        return view('m_user.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = UserModel::find($id);
        return view('m_user.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required|unique:posts|max:255',
            'nama' => 'required',
            'password' => 'required',
            'level_id'  => 'required',
        ]);

        $data = UserModel::find($id);

        if(Hash::check($request->password, $data->password)){
            $password = $data->password;
        }else{
            $password = Hash::make($request->password);
        }

        $data->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $password,
            'level_id' => $request->level_id,
        ]);

        return redirect()->route('user.index')->with('success','Data Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = UserModel::findorfail($id)->delete();
        return \redirect()->route('user.index')->with('success','Data Berhasil Dihapus!');
    }

    public function storeDashboard(Request $request)
    {
        $request->validate([
            'user_id' => 'max 20',
            'level_id' => 'required',
            'username' => 'required',
            'nama' => 'required',
            'password' => 'required',
        ]);

        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make('$request->password'),
            'level_id' => $request->level_id
        ]);

        return redirect('/')->with('Success','Data Berhasil Ditambahkan!');
    }
}
