<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penawaran extends Model
{
    use HasFactory;

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'id_pembeli');
    }

    public function barang_rampasan()
    {
        return $this->belongsTo(Barang_rampasan::class, 'id_barang');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }

    public function transaksi(){
        return $this->hasMany(Transaksi::class, 'id_penawaran');
    }

    protected $fillable = [
        'id_barang',
        'id_pembeli',
        'id_jadwal',
        'harga_bid',
        'tanggal',
        'status'
    ];

}
