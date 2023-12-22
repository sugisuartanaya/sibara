<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pembeli;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index',[
            'title' => 'Masuk',
            'active' => 'active'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);


        $user = User::where('role', '2')
            ->where(function ($query) use ($credentials) {
                $query->where('username', $credentials['username']);
            })
            ->first();

        if ($user && Auth::attempt($credentials)) {
            $pembeli = $user->pembeli;

            if ($pembeli) {
                $verifikasi = $pembeli->verifikasi->last();

                if ($verifikasi) {
                    $verifikasiStatus = $verifikasi->status;

                    if ($verifikasiStatus === 'verified') {
                        $request->session()->regenerate();
                        return redirect()->intended('/');

                    } else  {
                        Auth::logout(); // Log the user out
                        return back()->with('loginError', 'Akun Anda dalam proses verifikasi. Mohon menunggu konfirmasi melalui WhatsApp pada nomor telepon yang terdaftar.');
                    } 
                }
            }

            $request->session()->regenerate();
            return redirect()->intended('/');
        }


        return back()->with('loginError', 'Username atau password anda salah');
    }


    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/account/login');
    }

}
