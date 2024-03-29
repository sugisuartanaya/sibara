<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;
use App\Models\Harga_wajar;
use Illuminate\Http\Request;
use App\Models\Daftar_barang;
use App\Models\Barang_rampasan;
use App\Http\Controllers\DashboardController;

class JadwalController extends Controller
{
    public function index()
    {
        $statusPenawaran = DashboardController::statusPenawaran();
        $notif = DashboardController::notification();

        $jadwal = Jadwal::latest('id')->first();

        if($jadwal){
            $jadwal->start_date = Carbon::parse($jadwal->start_date);
            $jadwal->end_date = Carbon::parse($jadwal->end_date);
            
            $today = Carbon::now();
    
            if ($today->lt($jadwal->start_date)) {
                $status = 'coming_soon';
            } elseif ($today->gte($jadwal->start_date) && $today->lte($jadwal->end_date)) {
                $status = 'range_jadwal';
            } elseif ($today->gt($jadwal->end_date)) {
                $status = 'past_event';
            }
            
            $barang = Daftar_barang::where('id_jadwal', $jadwal->id)
            ->paginate(8);
        } else {
            $status = null;
            $barang = null;
        }

        return view('jadwal.index',[
            'title' => 'Jadwal',
            'active' => 'active',
            'jadwal' => $jadwal,
            'status' => $status,
            'daftar_barang' => $barang,
            'statusPenawaran' => $statusPenawaran,
            'notif' => $notif
        ]);
    }

}
