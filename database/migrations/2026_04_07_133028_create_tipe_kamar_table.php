<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipe_kamar', function (Blueprint $table) {
            $table->id('id_tipe_kamar'); // Ini otomatis auto_increment
            $table->string('nama_tipe', 50)->unique();
            $table->string('kode_tipe', 3)->unique();
            $table->integer('harga_per_malam');
            $table->string('deskripsi', 255);
            $table->text('foto_kamar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipe_kamar');
    }
};
