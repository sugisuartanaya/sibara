<?php

namespace App\Http\Controllers;

use App\Models\Barang_rampasan;
use App\Models\Kategori;
use App\Models\Harga_wajar;
use Illuminate\Http\Request;
use App\Models\Daftar_barang;

class BarangRampasanController extends Controller
{
    
    public function index()
    {
        $kategori = Kategori::all();
        $daftar_barang = Barang_rampasan::select('barang_rampasans.*', 'daftar_barangs.status', 'latest_prices.harga')
        ->join('daftar_barangs', 'barang_rampasans.id', '=', 'daftar_barangs.id_barang')
        ->leftJoin('harga_wajars as latest_prices', function ($join) {
            $join->on('barang_rampasans.id', '=', 'latest_prices.id_barang')
                ->whereRaw('latest_prices.tgl_laporan_penilaian = (select max(tgl_laporan_penilaian) from harga_wajars where id_barang = barang_rampasans.id)');
        })
        ->where('daftar_barangs.status', 1)
        ->paginate(8);

        return view('barangRampasan.index', [
            'title' => 'Barang',
            'active' => 'active',
            'daftar_barang' => $daftar_barang,
            'daftar_kategori' => $kategori
        ]);
    }

    public function filterUrutan(Request $request)
    {
        $kategori = Kategori::all();

        if ($request->urutan == 'terbaru'){
            $daftar_barang = Barang_rampasan::select('barang_rampasans.*', 'daftar_barangs.status', 'latest_prices.harga')
            ->join('daftar_barangs', 'barang_rampasans.id', '=', 'daftar_barangs.id_barang')
            ->leftJoin('harga_wajars as latest_prices', function ($join) {
                $join->on('barang_rampasans.id', '=', 'latest_prices.id_barang')
                    ->whereRaw('latest_prices.tgl_laporan_penilaian = (select max(tgl_laporan_penilaian) from harga_wajars where id_barang = barang_rampasans.id)');
            })
            ->where('daftar_barangs.status', 1)
            ->orderBy('barang_rampasans.id', 'desc')
            ->paginate(8);
        } elseif ($request->urutan == 'termurah') {
            $daftar_barang = Barang_rampasan::select('barang_rampasans.*', 'daftar_barangs.status', 'latest_prices.harga')
            ->join('daftar_barangs', 'barang_rampasans.id', '=', 'daftar_barangs.id_barang')
            ->leftJoin('harga_wajars as latest_prices', function ($join) {
                $join->on('barang_rampasans.id', '=', 'latest_prices.id_barang')
                    ->whereRaw('latest_prices.tgl_laporan_penilaian = (select max(tgl_laporan_penilaian) from harga_wajars where id_barang = barang_rampasans.id)');
            })
            ->where('daftar_barangs.status', 1)
            ->orderBy('latest_prices.harga', 'asc')
            ->paginate(8);
        } elseif ($request->urutan == 'termahal') {
            $daftar_barang = Barang_rampasan::select('barang_rampasans.*', 'daftar_barangs.status', 'latest_prices.harga')
            ->join('daftar_barangs', 'barang_rampasans.id', '=', 'daftar_barangs.id_barang')
            ->leftJoin('harga_wajars as latest_prices', function ($join) {
                $join->on('barang_rampasans.id', '=', 'latest_prices.id_barang')
                    ->whereRaw('latest_prices.tgl_laporan_penilaian = (select max(tgl_laporan_penilaian) from harga_wajars where id_barang = barang_rampasans.id)');
            })
            ->where('daftar_barangs.status', 1)
            ->orderBy('latest_prices.harga', 'desc')
            ->paginate(8);
        } 

        return view('barangRampasan.index', [
            'title' => 'Barang',
            'active' => 'active',
            'daftar_barang' => $daftar_barang,
            'daftar_kategori' => $kategori
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
