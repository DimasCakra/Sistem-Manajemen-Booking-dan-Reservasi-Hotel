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
            $table->string('id_type')->default('NIK')->after('whatsapp');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->string('id_type')->default('NIK')->after('user_id');
            $table->text('id_type_tamu_lain')->nullable()->after('id_number_tamu_lain');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('id_type');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['id_type', 'id_type_tamu_lain']);
        });
    }
};
