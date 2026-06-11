<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tipe_kamar', function (Blueprint $table) {
            $table->integer('jumlah_tamu')->default(2)->after('foto_kamar');
        });
    }

    public function down(): void
    {
        Schema::table('tipe_kamar', function (Blueprint $table) {
            $table->dropColumn('jumlah_tamu');
        });
    }
};
