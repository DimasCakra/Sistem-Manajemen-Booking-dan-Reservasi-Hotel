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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('id_admin', 100)->nullable()->unique();
            $table->string('id_resepsionis', 100)->nullable()->unique();
            $table->string('name', 100)->unique();
            $table->string('email', 100)->unique();
            $table->string('no_hp', 20)->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'receptionist']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
