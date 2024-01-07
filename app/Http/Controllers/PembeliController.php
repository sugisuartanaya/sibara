<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Jadwal;
use App\Models\Pembeli;
use App\Models\Penawaran;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PembeliController extends Controller
{
    public function index()
    {
        $statusPenawaran = DashboardController::statusPenawaran();

        return view('profile.index', [
            'title' => 'Profile',
            'active' => 'active',
            'statusPenawaran' => $statusPenawaran,
        ]);
    }

    public function showPenawaran()
    {
        $statusPenawaran = DashboardController::statusPenawaran();
        $penawaranAvailable = isset($statusPenawaran['penawaranAvailable']) ? $statusPenawaran['penawaranAvailable'] : null;
        $penawaranExpired = isset($statusPenawaran['penawaranExpired']) ? $statusPenawaran['penawaranExpired'] : null;
        
        if($penawaranExpired){
            $penawaranExpired->each(function ($penawaran) {
                $penawaran->tanggal = Carbon::parse($penawaran->tanggal)->format('j M Y \j\a\m H:i');
            });
        }
        if($penawaranAvailable){
            $penawaranAvailable->each(function ($penawaran) {
                $penawaran->tanggal = Carbon::parse($penawaran->tanggal)->format('j M Y \j\a\m H:i');
            });
        }

        return view('profile.penawaran',[
            'title' => 'Profile',
            'active' => 'active',
            'statusPenawaran' => $statusPenawaran,
            'penawaranExpired' => $penawaranExpired,
            'penawaranAvailable' => $penawaranAvailable,
        ]);
    }

    public function updateData($id)
    {
        $user = User::where('username', $id)->first();
        $pembeli = Pembeli::where('user_id', $user->id)->first();
        return view('pembeli.updateData',[
            'pembeli' => $pembeli
        ]);
    }

    public function updateProfile(Request $request, $id)
    {   

        $data_pembeli = User::where('username', $id)->first();
        $pembeli = Pembeli::where('user_id', $data_pembeli->id)->first();
        
        $verifikasiCollection = $pembeli->verifikasi;

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

        $verifikasi_nama = null;
        $verifikasi_pekerjaan = null;

        $verifikasi_terakhir = $verifikasiCollection->last();

        if ($verifikasi_terakhir) {
            $verifikasi_nama = in_array('nama_pembeli', json_decode($verifikasi_terakhir->jenis_kesalahan));
            $verifikasi_pekerjaan = in_array('pekerjaan', json_decode($verifikasi_terakhir->jenis_kesalahan));
        }

        if ($verifikasi_nama || $verifikasi_pekerjaan) {
            $pembeli->nama_pembeli = $verifikasi_nama ?  $request->nama_pembeli : $pembeli->nama_pembeli;
            $pembeli->pekerjaan = $verifikasi_pekerjaan ? $request->pekerjaan : $pembeli->pekerjaan;
        }
         
        $pembeli->save();

        $id_pembeli = $pembeli->id;

        Verifikasi::create([
            'id_pembeli' => $id_pembeli,
            'status' => 'revisi'
        ]);

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
