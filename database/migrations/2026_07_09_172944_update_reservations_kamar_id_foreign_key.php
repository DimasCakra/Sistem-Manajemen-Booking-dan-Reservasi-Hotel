<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['kamar_id']);
            $table->foreign('kamar_id')
                  ->references('id_kamar')
                  ->on('kamar')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['kamar_id']);
            $table->foreign('kamar_id')
                  ->references('id_kamar')
                  ->on('kamar')
                  ->onDelete('set null');
        });
    }
};
