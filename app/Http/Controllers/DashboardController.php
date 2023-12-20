<?php

namespace App\Http\Controllers;

use App\Models\Daftar_barang;
use App\Models\Harga_wajar;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
   
    public function index()
    {
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

        $daftar_barang = Daftar_barang::with(['barang_rampasan'])
            ->where('status', '1')
            ->select('id_barang')
            ->distinct()
            ->orderBy('id_barang', 'desc')
            ->limit(8)
            ->get();
        
        if($daftar_barang) {
            $id_barang = $daftar_barang->pluck('id_barang')->toArray();
            $harga = Harga_wajar::whereIn('id_barang', $id_barang)
                ->orderBy('tgl_laporan_penilaian', 'desc')  
                ->get()
                ->groupBy('id_barang')
                ->map(function ($group) {
                    return $group->first(); // Retrieve the first record for each group
                });
        } else {
            $daftar_barang = null;
            $harga = null;
        }

        return view('dashboard.index', [
            'title' => 'Beranda',
            'active' => 'active',
            'jadwal' => $jadwal,
            'status' => $status,
            'daftar_barang' => $daftar_barang,
            'harga_terakhir' => $harga
        ]);
        
    }

    public function create()
    {
        //
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
