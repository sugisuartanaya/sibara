<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'id_pembeli');
    }

    public function penawaran()
    {
        return $this->belongsTo(Penawaran::class, 'id_penawaran');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }

    protected $fillable = [
        'id_pembeli',
        'id_penawaran',
        'id_jadwal',
        'tanggal',
        'foto_bukti',
        'status'
    ];
}
