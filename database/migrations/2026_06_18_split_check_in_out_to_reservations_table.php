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
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
        });

        // Migrate data from check_in_out to check_in and check_out
        \DB::statement("
            UPDATE reservations 
            SET check_in = STR_TO_DATE(TRIM(SUBSTRING_INDEX(check_in_out, ' to ', 1)), '%Y-%m-%d'),
                check_out = STR_TO_DATE(TRIM(SUBSTRING_INDEX(check_in_out, ' to ', -1)), '%Y-%m-%d')
            WHERE check_in_out IS NOT NULL AND check_in_out != ''
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['check_in', 'check_out']);
        });
    }
};
