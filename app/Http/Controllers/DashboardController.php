<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
   
    public function index()
    {
        $jadwal = Jadwal::latest('id')->first();

        if ($jadwal) {
            // Jika ada jadwal
            $jadwal->start_date = Carbon::parse($jadwal->start_date);
            $jadwal->end_date = Carbon::parse($jadwal->end_date);
            
            // Cek jadwal di antara start_date dan end_date
            $range_jadwal = Carbon::today()->between($jadwal->start_date, $jadwal->end_date);
        
            return view('dashboard.index', [
                'title' => 'Beranda',
                'active' => 'active',
                'jadwal' => $jadwal,
                'range_jadwal' => $range_jadwal,
            ]);
        } else {
            // Jika tidak ada jadwal
            return view('dashboard.index', [
                'title' => 'Beranda',
                'active' => 'active',
                'jadwal' => null,  
                'range_jadwal' => false, 
            ]);
        }
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
