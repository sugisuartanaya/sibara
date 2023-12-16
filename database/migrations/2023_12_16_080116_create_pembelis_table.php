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
        Schema::create('pembelis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nama_pembeli');
            $table->string('pekerjaan');
            $table->string('no_telepon');
            $table->text('alamat');
            $table->text('foto_pembeli');
            $table->text('foto_ktp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelis');
    }
};
