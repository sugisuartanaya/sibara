<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
        'no_sprint',
        'tgl_sprint',
        'start_date',
        'end_date',
        'status'
    ];

    public function daftar_barang()
    {
        return $this->hasMany(Daftar_barang::class, 'id_jadwal');
    }

    public function penawaran()
    {
        return $this->hasMany(Penawaran::class, 'id_jadwal');
    }

    public function isExpired()
    {
        return now()->greaterThanOrEqualTo($this->end_date);
    }
}
