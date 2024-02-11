<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Models\Penawaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    
    public function index()
    {
        $statusPenawaran = DashboardController::statusPenawaran();

        $user = auth()->id();
        $pembeli = Pembeli::where('user_id', $user)->first();

        $transaksi = Transaksi::with('penawaran')
                    ->where('id_pembeli', $pembeli->id)
                    ->whereHas('penawaran', function ($query) {
                        $query->where('status', 'menang')
                        ->orderBy('updated_at', 'asc');
                    })
                    ->get();

        return view('profile.transaksi',[
            'title' => 'Profile',
            'active' => 'active',
            'statusPenawaran' => $statusPenawaran,
            'transaksi' => $transaksi
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
