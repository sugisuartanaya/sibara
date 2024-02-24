<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;
use App\Models\Pembeli;
use App\Models\Penawaran;
use App\Models\Transaksi;
use App\Models\Harga_wajar;
use Illuminate\Http\Request;
use App\Models\Daftar_barang;
use App\Models\Barang_rampasan;

class DashboardController extends Controller
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
        } else {
            $status = null;
        }

        $daftar_barang = Barang_rampasan::where('status', 0)
            ->whereHas('harga_wajar')
            ->whereHas('izin')
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();

        $id_barang = $daftar_barang->pluck('id')->toArray();
        
        $harga_terakhir = Harga_wajar::whereIn('id_barang', $id_barang)
            ->orderBy('tgl_laporan_penilaian', 'desc')  
            ->get()
            ->groupBy('id_barang')
            ->map(function ($group) {
                return $group->first(); // per group
            });
        
        $harga_awal = Harga_wajar::whereIn('id_barang', $id_barang)
            ->orderBy('tgl_laporan_penilaian', 'asc')  
            ->get()
            ->groupBy('id_barang')
            ->map(function ($group) {
                return $group->first(); // per group
            });

        return view('dashboard.index', [
            'title' => 'Beranda',
            'active' => 'active',
            'jadwal' => $jadwal,
            'status' => $status,
            'daftar_barang' => $daftar_barang,
            'harga_terakhir' => $harga_terakhir,
            'harga_awal' => $harga_awal,
            'statusPenawaran' => $statusPenawaran,
            'notif' => $notif
        ]);
        
    }

    public static function statusPenawaran()
    {
        $user = auth()->id();
        $pembeli = Pembeli::where('user_id', $user)->first();

        // Check if $pembeli is not null before proceeding
        if ($pembeli) {
            $jadwal = Jadwal::latest('id')->first();

            // Check if $jadwal is not null before proceeding
            if ($jadwal) {
                $productCount = Penawaran::with('jadwal')
                    ->selectRaw('MAX(harga_bid) as harga_bid, id_barang, status')
                    ->where('id_pembeli', $pembeli->id)
                    ->where('id_jadwal', $jadwal->id)
                    ->whereHas('jadwal', function ($query) {
                        $query->where('status', 'available');
                    })
                    ->orderBy('id', 'desc')
                    ->groupBy('id_barang', 'status')
                    ->get();

                $available = Penawaran::with('jadwal')
                    ->where('id_pembeli', $pembeli->id)
                    ->where('id_jadwal', $jadwal->id)
                    ->whereHas('jadwal', function ($query) {
                        $query->where('status', 'available');
                    })
                    ->orderBy('updated_at', 'desc')
                    ->paginate(5);

                $expired = Penawaran::with('jadwal') 
                    ->where('id_pembeli', $pembeli->id)
                    ->whereHas('jadwal', function ($query) {
                        $query->where('status', 'expired');
                    })
                    ->orderBy('updated_at', 'desc')
                    ->paginate(5);

                $productCount = $productCount->isEmpty() ? null : $productCount;
                $penawaranAvailable = $available->isEmpty() ? null : $available;
                $penawaranExpired = $expired->isEmpty() ? null : $expired;

                return ['productCount' => $productCount, 'penawaranExpired' => $penawaranExpired, 'penawaranAvailable' => $penawaranAvailable];
            } 
        }

    }

    public static function notification()
    {
        $user = auth()->id();
        $pembeli = Pembeli::where('user_id', $user)->first();

        $transaksi = Penawaran::where('id_pembeli', $pembeli->id)
                    ->where('status', 'menang')
                    ->whereDoesntHave('transaksi')
                    ->orderBy('updated_at', 'asc')
                    ->get();
        return ['transaksi' => $transaksi];
    } 

}