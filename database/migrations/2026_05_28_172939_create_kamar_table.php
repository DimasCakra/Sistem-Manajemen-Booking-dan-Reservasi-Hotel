<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kamar', function (Blueprint $table) {
            $table->integer('id_kamar')->autoIncrement();
            $table->string('no_kamar', 10)->unique();
            $table->string('tipe_kamar', 50);
            $table->string('status_kamar', 20);
            $table->integer('harga_per_malam');
            $table->string('deskripsi', 255);
            $table->text('foto_kamar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kamar');
    }
};
