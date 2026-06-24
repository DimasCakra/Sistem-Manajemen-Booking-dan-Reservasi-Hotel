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
                'id_number' => '1234567890123456',
                'password' => Hash::make('password123'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'dimas@gmail.com'],
            [
                'name' => 'Dimas Cakra',
                'whatsapp' => '09412940184',
                'id_number' => '1234567890123457',
                'password' => Hash::make('password123'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'bryan@gmail.com'],
            [
                'name' => 'Bryan',
                'whatsapp' => '08123456789',
                'id_number' => '1234567890123458',
                'password' => Hash::make('password123'),
            ]
        );


        \App\Models\Staff::updateOrCreate(
            ['name' => 'resepsionis'],
            [
                'id_resepsionis' => 'RES-001',
                'email' => 'resepsionis@stayease.com',
                'no_hp' => '08123456789',
                'password' => Hash::make('123456789'),
                'role' => 'receptionist'
            ]
        );

        \App\Models\Staff::updateOrCreate(
            ['name' => 'admin'],
            [
                'id_admin' => 'ADM-001',
                'email' => 'admin@stayease.com',
                'password' => Hash::make('123456789'),
                'role' => 'admin'
            ]
        );
    }
}
