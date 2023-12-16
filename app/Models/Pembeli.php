<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'is_verified' => 'boolean',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $fillable = [
        'user_id',
        'nama_pembeli',
        'pekerjaan',
        'no_telepon',
        'alamat',
        'foto_pembeli',
        'foto_ktp',
        'is_verified',
    ];
}
