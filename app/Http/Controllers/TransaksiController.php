<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pembeli;
use App\Models\Penawaran;
use App\Models\Transaksi;
use Carbon\Doctrine\CarbonDoctrineType;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    
    public function payment()
    {
        $statusPenawaran = DashboardController::statusPenawaran();

        $user = auth()->id();
        $pembeli = Pembeli::where('user_id', $user)->first();

        $countdownWinners = [];
        $payment = Penawaran::where('id_pembeli', $pembeli->id)
                    ->where('status', 'menang')
                    ->orderBy('updated_at', 'asc')
                    ->get();

        foreach ($payment as $pay) {
            $countdownWinners[] = Carbon::parse($pay->updated_at)->addHours(24)->toIso8601String();
        }

        $countdownWinner = !empty($countdownWinners) ? $countdownWinners[0] : null;
        $today = Carbon::now()->toIso8601String();

        if ($countdownWinner > $today) {
            $expired = false;
        } else {
            $expired = true;
        }

        return view('profile.pembayaran',[
            'title' => 'Profile',
            'active' => 'active',
            'statusPenawaran' => $statusPenawaran,
            'payment' => $payment,
            'countdownWinner' => $countdownWinner,
            'expired' => $expired
        ]);
    }

    public function transaction()
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

    
    public function invoice($id)
    {
        $statusPenawaran = DashboardController::statusPenawaran();

        $penawaran = Penawaran::where('id', $id)->first();

        return view('profile.invoice',[
            'title' => 'Profile',
            'active' => 'active',
            'statusPenawaran' => $statusPenawaran,
            'penawaran' => $penawaran
        ]);
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
