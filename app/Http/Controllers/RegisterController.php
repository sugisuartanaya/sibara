<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    
    public function index()
    {
        return view('register.index',[
            'title' => 'Daftar',
            'active' => 'active'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
            'nama_pembeli' => 'required',
            'role' => 'required',
            'pekerjaan' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'required',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_pembeli' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::create([
            'username' => $validatedData['username'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'],
        ]);

        // Simpan foto
        // Simpan foto KTP
        if ($request->hasFile('foto_ktp')) {
            $image_ktp = $request->file('foto_ktp');
            $path_ktp = $image_ktp->storeAs('public/photos', 'ktp_'.$request->nama_pembeli . time() . '.' . $image_ktp->getClientOriginalExtension());
            $url_ktp = Storage::url($path_ktp);
        }

        // Simpan foto pembeli
        if ($request->hasFile('foto_pembeli')) {
            $image_pembeli = $request->file('foto_pembeli');
            $path_pembeli = $image_pembeli->storeAs('public/photos', 'pembeli_'.$request->nama_pembeli . time() . '.' . $image_pembeli->getClientOriginalExtension());
            $url_pembeli = Storage::url($path_pembeli);
        }

        Pembeli::create([
            'user_id' => $user->id,
            'nama_pembeli' => $validatedData['nama_pembeli'],
            'pekerjaan' => $validatedData['pekerjaan'],
            'no_telepon' => $validatedData['no_telepon'],
            'alamat' => $validatedData['alamat'],
            'foto_ktp' => $url_ktp,
            'foto_pembeli' => $url_pembeli,
            'is_verified' => $request->has('is_verified')
        ]);

        // Set flash message
        Session::flash('success');

        return redirect('/');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
