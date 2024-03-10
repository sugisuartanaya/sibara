<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pembeli;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
         // Validasi data user
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
            'nama_pembeli' => 'required',
            'role' => 'required',
            'pekerjaan' => 'required',
            'no_telepon' => 'required|numeric',
            'alamat' => 'required',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_pembeli' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'username.required' => 'Username belum diisi',
            'username.unique' => 'Username sudah digunakan',
            'email.required' => 'email belum diisi',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password belum diisi',
            'password.min' => 'Password minimal terdiri dari :min karakter',
            'nama_pembeli.required' => 'Nama belum diisi',
            'role.required' => 'Role belum diisi',
            'pekerjaan.required' => 'Pekerjaan belum diisi',
            'no_telepon.required' => 'Nomor telepon belum diisi',
            'no_telepon.numeric' => 'Nomor telepon harus dalam angka',
            'alamat.required' => 'Alamat belum diisi',
            'foto_ktp.required' => 'Foto KTP belum diunggah',
            'foto_ktp.image' => 'File harus berupa gambar',
            'foto_ktp.mimes' => 'Format file harus jpeg, png, jpg, atau gif',
            'foto_ktp.max' => 'Ukuran file tidak boleh lebih dari 2MB',
            'foto_pembeli.required' => 'Foto pembeli belum diunggah',
            'foto_pembeli.image' => 'File harus berupa gambar',
            'foto_pembeli.mimes' => 'Format file harus jpeg, png, jpg, atau gif',
            'foto_pembeli.max' => 'Ukuran file tidak boleh lebih dari 2MB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Buat entitas User
        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role'),
            // sesuaikan dengan kolom lainnya
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
            'nama_pembeli' => $request->input('nama_pembeli'),
            'pekerjaan' => $request->input('pekerjaan'),
            'no_telepon' => $request->input('no_telepon'),
            'alamat' => $request->input('alamat'),
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
