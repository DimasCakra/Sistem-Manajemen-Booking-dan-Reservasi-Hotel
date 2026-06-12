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
        Schema::table('reservations', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('nik')->nullable();
            $table->string('nama_tamu_lain')->nullable();
            $table->string('nik_tamu_lain')->nullable();
            $table->text('permintaan_khusus')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->string('payment_method')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'user_id',
                'nik',
                'nama_tamu_lain',
                'nik_tamu_lain',
                'permintaan_khusus',
                'bukti_pembayaran',
                'payment_method'
            ]);
        });
    }
};
