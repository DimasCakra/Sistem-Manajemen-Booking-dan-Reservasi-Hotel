<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kamar', function (Blueprint $table) {
            // ID auto-increment sebagai Primary Key
            $table->id();

            // no_kamar sekarang menjadi kolom string biasa
            $table->string('no_kamar', 20)->unique();

            $table->unsignedBigInteger('id_tipe_kamar');
            $table->string('status_kamar', 20)->default('tersedia');
            $table->timestamps();

            $table->foreign('id_tipe_kamar')
                ->references('id_tipe_kamar')
                ->on('tipe_kamar')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kamar');
    }
};
