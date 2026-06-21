<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('kamar_id')->nullable()->after('room_number');
            $table->foreign('kamar_id')->references('id_kamar')->on('kamar')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['kamar_id']);
            $table->dropColumn('kamar_id');
        });
    }
};
