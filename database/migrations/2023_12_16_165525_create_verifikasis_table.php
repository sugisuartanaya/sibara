<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifikasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pembeli');
            $table->enum('status', ['belum_verified', 'data_salah', 'verified'])->default('belum_verified');
            $table->enum('jenis_kesalahan', ['nihil','nama_pembeli', 'pekerjaan', 'foto'])->default('nihil');
            $table->text('komentar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verifikasis');
    }
};
