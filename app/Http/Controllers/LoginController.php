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

        $user = User::where('username', $credentials['username'])->first();

        if ($user && Auth::attempt($credentials)) {
            $pembeli = $user->pembeli;

            if ($pembeli) {
                $verifikasiStatus = $pembeli->verifikasi ? $pembeli->verifikasi->status : null;

                if ($verifikasiStatus === 'belum_verified') {
                    Auth::logout(); // Log the user out
                    return back()->with('loginError', 'Akun Anda belum diverifikasi. Mohon menunggu konfirmasi melalui WhatsApp pada nomor telepon yang terdaftar.');
                } elseif ($verifikasiStatus === 'data_salah') {
                    $request->session()->regenerate();
                    // Redirect the user to the edit page with additional data
                    return redirect()->intended('/account/profile/edit')->with([
                        'title' => 'Masuk',
                        'active' => 'active'
                    ]);
                }
            }

            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Login gagal!');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/account/login');
    }

}
