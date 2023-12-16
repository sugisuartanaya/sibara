<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verifikasi extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function pembeli(){
        return $this->belongsTo(Pembeli::class, 'id_pembeli');
    }

    protected $fillable = [
        'id_pembeli',
        'status',
        'jenis_kesalahan',
        'komentar',
    ];
}
