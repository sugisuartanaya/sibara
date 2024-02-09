<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        
        Schema::create('penawarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pembeli');
            $table->foreignId('id_barang');
            $table->foreignId('id_jadwal');
            $table->integer('harga_bid');
            $table->enum('status', ['pending', 'wanprestasi', 'kalah', 'menang'])->default('pending');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('penawarans');
    }
};
