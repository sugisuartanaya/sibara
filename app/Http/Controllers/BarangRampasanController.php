<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;
use App\Models\Kategori;
use App\Models\Harga_wajar;
use Illuminate\Http\Request;
use App\Models\Daftar_barang;
use App\Models\Barang_rampasan;

class BarangRampasanController extends Controller
{
    
    public function index()
    {
        $kategori = Kategori::all();

        $daftar_barang = Barang_rampasan::select(
            'barang_rampasans.*',
            'harga_wajars.harga'
            )
            ->where('barang_rampasans.status', 0)
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
        ]);

    }

    public function filter(Request $request)
    {
        $kategori = Kategori::all();
        $keyword = $request->input('search');
        
        $daftar_barang = Barang_rampasan::select(
            'barang_rampasans.*', 
            'harga_wajars.harga'
            )
        ->where('barang_rampasans.status', 0)
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
        ->paginate(8);

        return view('barangRampasan.index', [
            'title' => 'Barang',
            'active' => 'active',
            'daftar_barang' => $daftar_barang,
            'daftar_kategori' => $kategori,
            'request' => $request
        ]);
    }

    public function show($id)
    {
        $barang = Barang_rampasan::find($id);
        $fotoBarangArray = json_decode($barang->foto_barang, true);
        $harga = Harga_wajar::where('id_barang', $id)->latest('tgl_laporan_penilaian')->first();
        $jadwal_terkait = Daftar_barang::where('id_barang', $id)->first()?->jadwal;

        return view('barangRampasan.show', [
            'title' => 'Barang',
            'active' => 'active',
            'data_barang' => $barang,
            'foto_barang' => $fotoBarangArray,
            'harga' => $harga,
            'jadwal' => optional($jadwal_terkait)->end_date,
        ]);
    }

        // $daftar_barang = Barang_rampasan::select('barang_rampasans.*', 'daftar_barangs.status', 'latest_prices.harga')
        // ->join('daftar_barangs', 'barang_rampasans.id', '=', 'daftar_barangs.id_barang')
        // ->leftJoin('harga_wajars as latest_prices', function ($join) {
        //     $join->on('barang_rampasans.id', '=', 'latest_prices.id_barang')
        //         ->whereRaw('latest_prices.tgl_laporan_penilaian = (select max(tgl_laporan_penilaian) from harga_wajars where id_barang = barang_rampasans.id)');
        // })
        // ->where('daftar_barangs.status', 1)
        // ->paginate(8);

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
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
