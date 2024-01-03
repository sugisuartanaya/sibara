<?php

namespace App\Http\Controllers;

use App\Models\Barang_rampasan;
use App\Models\Jadwal;
use App\Models\Penawaran;
use Illuminate\Http\Request;
use App\Models\Daftar_barang;

class PengumumanController extends Controller
{
    
    public function index()
    {
        $statusPenawaran = DashboardController::statusPenawaran();
        $jadwal = Jadwal::latest('id')
                    ->where('status', 'expired')
                    ->first();
        if($jadwal){
            $id_jadwal = $jadwal->id;

            $barangs = Barang_rampasan::whereHas('daftar_barang', function ($query) use ($id_jadwal) {
                $query->where('id_jadwal', $id_jadwal);
            })->get();

            $bidderTertinggi = [];

            foreach ($barangs as $barang) {
            $penawarTertinggi = Penawaran::where('id_jadwal', $id_jadwal)
                ->where('id_barang', $barang->id)
                ->orderBy('harga_bid', 'desc')
                ->first();

                if ($penawarTertinggi) {
                    $bidderTertinggi[$barang->id] = $penawarTertinggi;
                }
            }
        } else {
            $bidderTertinggi = null;
            $barangs = null;
        }
        
        // dd($bidderTertinggi);

        return view('pengumuman.index', [
            'title' => 'Pengumuman',
            'active' => 'active',
            'statusPenawaran' => $statusPenawaran,
            'daftar_barang' => $barangs,
            'penawarTertinggi' => $bidderTertinggi,
            'jadwal' => $jadwal
        ]);
    }

    
    
}
