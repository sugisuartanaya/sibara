<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PembeliController extends Controller
{
    public function index()
    {
        //
    }

    public function myProfile()
    {
        return view('profile.edit',[
            'title' => 'Profile',
            'active' => 'active',
        ]);
    }

    public function updateProfile(Request $request, $id)
    {   

        $data_pembeli = User::where('username', $id)->first();
        $pembeli = Pembeli::where('user_id', $data_pembeli->id)->first();

        if ($request->hasFile('foto_ktp')) {
            $image_ktp = $request->file('foto_ktp');
            $path_ktp = $image_ktp->storeAs('public/photos', 'ktp_'.$request->nama_pembeli . time() . '.' . $image_ktp->getClientOriginalExtension());
            $url_ktp = Storage::url($path_ktp);
            $pembeli->foto_ktp = $url_ktp;  

        }

        // Simpan foto pembeli
        if ($request->hasFile('foto_pembeli')) {
            $image_pembeli = $request->file('foto_pembeli');
            $path_pembeli = $image_pembeli->storeAs('public/photos', 'pembeli_'.$request->nama_pembeli . time() . '.' . $image_pembeli->getClientOriginalExtension());
            $url_pembeli = Storage::url($path_pembeli);
            $pembeli->foto_pembeli = $url_pembeli;  

        }

        $pembeli->nama_pembeli = $request->nama_pembeli;  
        $pembeli->pekerjaan = $request->pekerjaan;  
        $pembeli->save();

        Session::flash('success', 'Berhasil update data. Mohon menunggu admin untuk verifikasi kembali');
        return redirect('/');

    }

    public function store(Request $request)
    {
        //
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
