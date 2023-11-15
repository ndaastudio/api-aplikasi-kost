<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kos');
            $table->string('alamat');
            $table->integer('provinsi');
            $table->integer('kota');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->integer('jumlah_kamar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kos');
    }
};
