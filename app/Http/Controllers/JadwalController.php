<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;
use App\Models\Barang_rampasan;
use App\Models\Harga_wajar;
use Illuminate\Http\Request;

class JadwalController extends Controller
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

        $daftar_barang = Barang_rampasan::where('status', 0)
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
            
        return view('jadwal.index',[
            'title' => 'Jadwal',
            'active' => 'active',
            'jadwal' => $jadwal,
            'status' => $status,
            'daftar_barang' => $daftar_barang,
            'harga_terakhir' => $harga_terakhir,
            'harga_awal' => $harga_awal
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