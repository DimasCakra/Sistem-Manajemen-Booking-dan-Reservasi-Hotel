<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Receptionist;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Dummy Guest
        User::updateOrCreate(
            ['email' => 'damarwidhinugroho@gmail.com'],
            [
                'name' => 'Damar Widi Nugroho',
                'whatsapp' => '082169784529',
                'username' => 'damar',
                'password' => Hash::make('password123'),
            ]
        );

        // Dummy Receptionist
        Receptionist::updateOrCreate(
            ['email' => 'resepsionis@gmail.com'],
            ['name' => 'resepsionis', 'password' => Hash::make('123456789')]
        );

        // Dummy Admin
        Admin::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'admin1', 'password' => Hash::make('123456789')]
        );
    }
}
