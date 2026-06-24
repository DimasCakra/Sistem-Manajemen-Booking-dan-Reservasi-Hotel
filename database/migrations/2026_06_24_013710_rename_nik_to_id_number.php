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
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'nik')) {
                $table->renameColumn('nik', 'id_number');
            }
        });

        Schema::table('reservations', function (Blueprint $table) {
            if (Schema::hasColumn('reservations', 'nik')) {
                $table->renameColumn('nik', 'id_number');
            }
            if (Schema::hasColumn('reservations', 'nik_tamu_lain')) {
                $table->renameColumn('nik_tamu_lain', 'id_number_tamu_lain');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('id_number', function (Blueprint $table) {
            //
        });
    }
};
