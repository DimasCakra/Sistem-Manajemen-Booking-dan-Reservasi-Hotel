<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('kamar');

        Schema::create('kamar', function (Blueprint $table) {
            $table->string('id_kamar')->primary();
            $table->string('no_kamar', 20);
            $table->unsignedBigInteger('id_tipe_kamar');
            $table->enum('status_kamar', ['tersedia', 'terisi'])->default('tersedia');
            $table->timestamps();

            $table->foreign('id_tipe_kamar')
                ->references('id_tipe_kamar')
                ->on('tipe_kamar')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kamar');
    }
};
