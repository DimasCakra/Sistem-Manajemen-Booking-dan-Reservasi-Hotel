<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('reservations', function (Blueprint $table) {
        $table->id();
        $table->string('room_type');
        $table->string('room_number');
        $table->string('nama_lengkap');
        $table->string('whatsapp');
        $table->string('email');
        $table->string('jumlah_tamu');
        $table->string('check_in_out');
        $table->string('status')->default('ongoing'); // ongoing, done
        $table->integer('total_biaya');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
