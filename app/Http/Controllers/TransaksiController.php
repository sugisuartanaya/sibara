<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pembeli;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Penawaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
                    ->whereDoesntHave('transaksi')
                    ->orderBy('updated_at', 'asc')
                    ->get();
       
        foreach ($payment as $pay) {
            if ($pay->transaksi->isEmpty()) {
                $countdownWinners[] = Carbon::parse($pay->updated_at)->addHours(24)->toIso8601String();
            } else {
                $payment = [];
            }
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
            'countdownWinner' => $countdownWinners,
            'expired' => $expired
        ]);
    }

    public function transaction()
    {
        $statusPenawaran = DashboardController::statusPenawaran();

        $user = auth()->id();
        $pembeli = Pembeli::where('user_id', $user)->first();
        
        $countdownWinners = [];
        $transaksi = Transaksi::where('id_pembeli', $pembeli->id)->get();
        
        // dd($transaksi);

        foreach ($transaksi as $trans) {
            $id_penawaran = $trans->id_penawaran;
            $penawaran = Penawaran::find($id_penawaran);
            $countdownWinners[] = Carbon::parse($penawaran->updated_at)->addHours(24)->toIso8601String();
        }

        $countdownWinner = !empty($countdownWinners) ? $countdownWinners[0] : null;

        return view('profile.transaksi',[
            'title' => 'Profile',
            'active' => 'active',
            'statusPenawaran' => $statusPenawaran,
            'transaksi' => $transaksi,
            'countdownWinner' => $countdownWinner,
        ]);
    }

    
    public function invoice($id)
    {
        $statusPenawaran = DashboardController::statusPenawaran();

        $user = auth()->id();
        $pembeli = Pembeli::where('user_id', $user)->first();

        $penawaran = Penawaran::where('id_pembeli', $pembeli->id)
                    ->where('id', $id)
                    ->first();
        $countdownWinners = Carbon::parse($penawaran->updated_at)->addHours(24)->toIso8601String();
        $today = Carbon::now()->toIso8601String();

        if ($countdownWinners > $today) {
            $expired = false;
        } else {
            $expired = true;
        }

        return view('profile.invoice',[
            'title' => 'Profile',
            'active' => 'active',
            'statusPenawaran' => $statusPenawaran,
            'penawaran' => $penawaran,
            'countdownWinner' => $countdownWinners,
            'expired' => $expired
        ]);
    }

    public function revisi($id)
    {
        $statusPenawaran = DashboardController::statusPenawaran();

        $user = auth()->id();
        $pembeli = Pembeli::where('user_id', $user)->first();

        $penawaran = Penawaran::where('id_pembeli', $pembeli->id)
                    ->where('id', $id)
                    ->first();
        $countdownWinners = Carbon::parse($penawaran->updated_at)->addHours(24)->toIso8601String();
        $today = Carbon::now()->toIso8601String();

        if ($countdownWinners > $today) {
            $expired = false;
        } else {
            $expired = true;
        }

        return view('profile.revisi',[
            'title' => 'Profile',
            'active' => 'active',
            'statusPenawaran' => $statusPenawaran,
            'penawaran' => $penawaran,
            'countdownWinner' => $countdownWinners,
            'expired' => $expired
        ]);
    }

    public function upload(Request $request)
    {
        $image = $request->file('foto_bukti');
        $path = $image->storeAs('public/photos/transaksi', 'transaksi_'.$request->nama_pembeli . time() . '.' . $image->getClientOriginalExtension());
        $url_transaksi = Storage::url($path);

        $today = Carbon::now();

        Transaksi::create([
            'id_pembeli' => $request->input('id_pembeli'),
            'id_penawaran' => $request->input('id_penawaran'),
            'tanggal' => $today,
            'foto_bukti' => $url_transaksi,
        ]);
        
        Session::flash('success', 'Transaksi anda sedang dicheck oleh admin');
        return redirect('transaksi');
    }

    public function uploadRevisi(Request $request, $id)
    {
        $image = $request->file('foto_bukti');
        $path = $image->storeAs('public/photos/transaksi', 'transaksi_'.$request->nama_pembeli . time() . '.' . $image->getClientOriginalExtension());
        $url_transaksi = Storage::url($path);

        $today = Carbon::now();

        $transaksi = Transaksi::where('id_penawaran', $id)->first();
        $transaksi->tanggal = $today;
        $transaksi->status = 'review';
        $transaksi->foto_bukti = $url_transaksi;
        $transaksi->save();
        
        Session::flash('success', 'Transaksi anda sedang dicheck oleh admin');
        return redirect('transaksi');
    }

    
    public function printPdf($id){
        $transaksi = Transaksi::find($id);
        $pdf = PDF::loadView('pdf.bukti_pembayaran', ['transaksi' => $transaksi]);
        return $pdf->download('bukti_pembayaran.pdf');
        // return view('pdf.bukti');
    }
}
