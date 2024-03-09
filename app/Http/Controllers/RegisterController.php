<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pembeli;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
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

            $fileName = 'ktp_'.$request->nama_pembeli . time() . '.' . $image_ktp->getClientOriginalExtension();

            // Path untuk menyimpan gambar di dalam folder storage
            $storagePath = $image_ktp->storeAs('public/photos/pembeli/', $fileName);

            // Path untuk menyimpan gambar di dalam folder public
            $publicPath = public_path('photos/pembeli/' . $fileName);

            // Resize gambar sebelum disimpan
            $img = Image::make($image_ktp);
            $img->save($publicPath); // Simpan gambar di folder public

            // URL gambar yang akan disimpan di database
            $url_ktp = asset('photos/pembeli/' . $fileName);
        }

        // Simpan foto pembeli
        if ($request->hasFile('foto_pembeli')) {
            $image_pembeli = $request->file('foto_pembeli');

            $fileName = 'selfie_'.$request->nama_pembeli . time() . '.' . $image_pembeli->getClientOriginalExtension();

            // Path untuk menyimpan gambar di dalam folder storage
            $storagePath = $image_pembeli->storeAs('public/photos/pembeli/', $fileName);

            // Path untuk menyimpan gambar di dalam folder public
            $publicPath = public_path('photos/pembeli/' . $fileName);

            // Resize gambar sebelum disimpan
            $img = Image::make($image_pembeli);
            $img->save($publicPath); // Simpan gambar di folder public

            // URL gambar yang akan disimpan di database
            $url_pembeli = asset('photos/pembeli/' . $fileName);
        }

        $pembeli = Pembeli::create([
            'user_id' => $user->id,
            'nama_pembeli' => $validatedData['nama_pembeli'],
            'pekerjaan' => $validatedData['pekerjaan'],
            'no_telepon' => $validatedData['no_telepon'],
            'alamat' => $validatedData['alamat'],
            'foto_ktp' => $url_ktp,
            'foto_pembeli' => $url_pembeli,
            // 'is_verified' => $request->has('is_verified')
        ]);

        $id_pembeli = $pembeli->id;

        Verifikasi::create([
            'id_pembeli' => $id_pembeli,
        ]);

        // Set flash message
        Session::flash('success');

        return redirect('/');

    }

}
