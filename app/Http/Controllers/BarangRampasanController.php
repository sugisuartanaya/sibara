<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;
use App\Models\Pembeli;
use App\Models\Kategori;
use App\Models\Penawaran;
use App\Models\Harga_wajar;
use Illuminate\Http\Request;
use App\Models\Daftar_barang;
use App\Models\Barang_rampasan;
use App\Http\Controllers\DashboardController;

class BarangRampasanController extends Controller
{
    
    public function index()
    {
        $statusPenawaran = DashboardController::statusPenawaran();
        $notif = DashboardController::notification();

        $kategori = Kategori::all();

        $daftar_barang = Barang_rampasan::select(
            'barang_rampasans.*',
            'harga_wajars.harga'
            )
            ->where('barang_rampasans.status', 0)
            ->wherehas('izin')
            ->wherehas('harga_wajar')
            ->leftJoin('harga_wajars', function($join) {
                $join->on('barang_rampasans.id', '=', 'harga_wajars.id_barang')
                    ->whereRaw('harga_wajars.id = (SELECT id FROM harga_wajars WHERE id_barang = barang_rampasans.id ORDER BY tgl_laporan_penilaian DESC LIMIT 1)');
            })
            ->paginate(8);
        
        return view('barangRampasan.index', [
            'title' => 'Barang',
            'active' => 'active',
            'daftar_barang' => $daftar_barang,
            'daftar_kategori' => $kategori,
            'statusPenawaran' => $statusPenawaran,
            'notif' => $notif
        ]);

    }

    public function filter(Request $request)
    {
        $statusPenawaran = DashboardController::statusPenawaran();
        $notif = DashboardController::notification();

        $kategori = Kategori::all();
        $keyword = $request->input('search');

        $minimum = str_replace('.', '', $request->input('minimum'));
        $maximum = str_replace('.', '', $request->input('maximum'));
        //ubah string ke int
        $minimumNumeric = intval($minimum);
        $maximumNumeric = intval($maximum);
        
        $daftar_barang = Barang_rampasan::select(
            'barang_rampasans.*', 
            'harga_wajars.harga'
            )
        ->where('barang_rampasans.status', 0)
        ->whereHas('izin')
        ->whereHas('harga_wajar')
        ->leftJoin('harga_wajars', function($join) {
            $join->on('barang_rampasans.id', '=', 'harga_wajars.id_barang')
                ->whereRaw('harga_wajars.id = (SELECT id FROM harga_wajars WHERE id_barang = barang_rampasans.id ORDER BY tgl_laporan_penilaian DESC LIMIT 1)');
        })
        ->when($request->has('kategori'), function ($query) use ($request) {
            return $query->whereHas('kategori', function ($q) use ($request) {
                $q->whereIn('kategori_id', $request->kategori);
            });
        })
        ->when($keyword, function ($query, $keyword) {
            return $query->where('barang_rampasans.nama_barang', 'like', '%' . $keyword . '%');
        })
        ->when($request->has('urutan'), function ($query) use ($request) {
            if ($request->urutan == 'terbaru') {
                return $query->orderBy('barang_rampasans.id', 'desc');
            } elseif ($request->urutan == 'termurah') {
                return $query->orderBy('harga_wajars.harga', 'asc');
            } elseif ($request->urutan == 'termahal') {
                return $query->orderBy('harga_wajars.harga', 'desc');
            }
        })
        ->when($request->filled(['minimum', 'maximum']), function ($query) use ($minimumNumeric, $maximumNumeric) {
            $query->whereBetween('harga_wajars.harga', [$minimumNumeric, $maximumNumeric]);
        })
        ->paginate(8);

        return view('barangRampasan.index', [
            'title' => 'Barang',
            'active' => 'active',
            'daftar_barang' => $daftar_barang,
            'daftar_kategori' => $kategori,
            'request' => $request,
            'statusPenawaran' => $statusPenawaran,
            'notif' => $notif
        ]);
    }

    public function checkTypeBid($id){
        $jadwal_terkait = Daftar_barang::where('id_barang', $id)->latest('id')->first()?->jadwal;
        if ($jadwal_terkait === null){
           return $this->offBid($id);
        } else {
            $type = $jadwal_terkait->type;
            if ($type == 'open') {
                return $this->openBid($id);
            } else {
                return $this->closeBid($id);
            }
        }
    }

    public function openBid($id)
    {
        $statusPenawaran = DashboardController::statusPenawaran();
        $notif = DashboardController::notification();

        $barang = Barang_rampasan::find($id);
        $fotoBarangArray = json_decode($barang->foto_barang, true);
        $harga = Harga_wajar::where('id_barang', $id)->latest('tgl_laporan_penilaian')->first();
        $jadwal_terkait = Daftar_barang::where('id_barang', $id)->latest('id')->first()?->jadwal;

        if($jadwal_terkait){
            $jadwal_terkait->start_date = Carbon::parse($jadwal_terkait->start_date);
            $jadwal_terkait->end_date = Carbon::parse($jadwal_terkait->end_date);
            
            $today = Carbon::now();
    
            if ($today->lt($jadwal_terkait->start_date)) {
                $status = 'coming_soon';
            } elseif ($today->gte($jadwal_terkait->start_date) && $today->lte($jadwal_terkait->end_date)) {
                $status = 'range_jadwal';
            } elseif ($today->gt($jadwal_terkait->end_date)) {
                $status = 'past_event';
            } 
        } else {
            $status = null;
        }
        
        $penawaran = Penawaran::where('id_barang', $id)
        ->where('id_jadwal', $jadwal_terkait->id)
        ->orderBy('harga_bid', 'desc')
        ->paginate(3);

        return view('barangRampasan.openBid', [
            'title' => 'Barang',
            'active' => 'active',
            'data_barang' => $barang,
            'foto_barang' => $fotoBarangArray,
            'harga' => $harga,
            'status' => $status,
            'jadwal' => optional($jadwal_terkait),
            'tawaran' => $penawaran,
            'statusPenawaran' => $statusPenawaran,
            'notif' => $notif
        ]);
    }

    public function closeBid($id)
    {
        $statusPenawaran = DashboardController::statusPenawaran();
        $notif = DashboardController::notification();

        $barang = Barang_rampasan::find($id);
        $fotoBarangArray = json_decode($barang->foto_barang, true);
        $harga = Harga_wajar::where('id_barang', $id)->latest('tgl_laporan_penilaian')->first();
        $jadwal_terkait = Daftar_barang::where('id_barang', $id)->latest('id')->first()?->jadwal;

        if($jadwal_terkait){
            $jadwal_terkait->start_date = Carbon::parse($jadwal_terkait->start_date);
            $jadwal_terkait->end_date = Carbon::parse($jadwal_terkait->end_date);
            
            $today = Carbon::now();
    
            if ($today->lt($jadwal_terkait->start_date)) {
                $status = 'coming_soon';
            } elseif ($today->gte($jadwal_terkait->start_date) && $today->lte($jadwal_terkait->end_date)) {
                $status = 'range_jadwal';
            } elseif ($today->gt($jadwal_terkait->end_date)) {
                $status = 'past_event';
            } 
        } else {
            $status = null;
        }
        
        $user = auth()->id();
        $pembeli = Pembeli::where('user_id', $user)->first();
        if ($pembeli) {
            $penawaran = Penawaran::where('id_barang', $id)
                ->where('id_pembeli', $pembeli->id)
                ->where('id_jadwal', $jadwal_terkait->id)
                ->first();
        } else {
            $penawaran = null;
        }

        return view('barangRampasan.closeBid', [
            'title' => 'Barang',
            'active' => 'active',
            'data_barang' => $barang,
            'foto_barang' => $fotoBarangArray,
            'harga' => $harga,
            'status' => $status,
            'jadwal' => optional($jadwal_terkait),
            'tawaran' => $penawaran,
            'statusPenawaran' => $statusPenawaran,
            'notif' => $notif
        ]);
    }

    public function offBid($id)
    {
        $statusPenawaran = DashboardController::statusPenawaran();
        $notif = DashboardController::notification();

        $barang = Barang_rampasan::find($id);
        $fotoBarangArray = json_decode($barang->foto_barang, true);
        $harga = Harga_wajar::where('id_barang', $id)->latest('tgl_laporan_penilaian')->first();
        $jadwal_terkait = Daftar_barang::where('id_barang', $id)->latest('id')->first()?->jadwal;

        if($jadwal_terkait){
            $jadwal_terkait->start_date = Carbon::parse($jadwal_terkait->start_date);
            $jadwal_terkait->end_date = Carbon::parse($jadwal_terkait->end_date);
            $today = Carbon::now();
    
            if ($today->lt($jadwal_terkait->start_date)) {
                $status = 'coming_soon';
            } elseif ($today->gte($jadwal_terkait->start_date) && $today->lte($jadwal_terkait->end_date)) {
                $status = 'range_jadwal';
            } elseif ($today->gt($jadwal_terkait->end_date)) {
                $status = 'past_event';
            } 
        } else {
            $status = null;
        }
        
        $user = auth()->id();
        $pembeli = Pembeli::where('user_id', $user)->first();
        if ($pembeli) {
            if($jadwal_terkait) {
                $penawaran = Penawaran::where('id_barang', $id)
                ->where('id_pembeli', $pembeli->id)
                ->where('id_jadwal', $jadwal_terkait->id)
                ->first();
            } else {
                $penawaran = null;
            }
        } else {
            $penawaran = null;
        }

        return view('barangRampasan.offBid', [
            'title' => 'Barang',
            'active' => 'active',
            'data_barang' => $barang,
            'foto_barang' => $fotoBarangArray,
            'harga' => $harga,
            'status' => $status,
            'jadwal' => optional($jadwal_terkait),
            'tawaran' => $penawaran,
            'statusPenawaran' => $statusPenawaran,
            'notif' => $notif
        ]);
    }
    
}
