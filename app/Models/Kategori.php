<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    public function barang_rampasan()
    {
        return $this->hasMany(Barang_rampasan::class, 'kategori_id');
    }
}
