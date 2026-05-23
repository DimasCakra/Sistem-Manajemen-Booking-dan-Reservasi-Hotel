<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Receptionist;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        User::updateOrCreate(
            ['email' => 'damarwidhinugroho@gmail.com'],
            [
                'name' => 'Damar Widi Nugroho',
                'whatsapp' => '082169784529',
                'username' => 'damar',
                'password' => Hash::make('password123'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'dimas@gmail.com'],
            [
                'name' => 'Dimas Cakra',
                'whatsapp' => '09412940184',
                'username' => 'dimas',
                'password' => Hash::make('password123'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'bryan@gmail.com'],
            [
                'name' => 'Bryan',
                'whatsapp' => '08123456789',
                'username' => 'bryan',
                'password' => Hash::make('password123'),
            ]
        );


        \App\Models\Staff::updateOrCreate(
            ['name' => 'resepsionis'],
            [
                'id_resepsionis' => 'RES-001',
                'password' => Hash::make('123456789'),
                'role' => 'receptionist'
            ]
        );

        \App\Models\Staff::updateOrCreate(
            ['name' => 'admin'],
            [
                'id_admin' => 'ADM-001',
                'password' => Hash::make('123456789'),
                'role' => 'admin'
            ]
        );
    }
}
