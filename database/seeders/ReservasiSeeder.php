<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

// Nama class ini HARUS sama dengan nama file
class ReservasiSeeder extends Seeder
{
    public function run(): void
    {
        // Data 1: Briyan
        Reservation::create([
            'room_type' => 'Standard Room',
            'room_number' => '102',
            'nama_lengkap' => 'Briyan Abisai',
            'whatsapp' => '081234567890',
            'email' => 'briyan@gmail.com',
            'jumlah_tamu' => '2 Person',
            'check_in_out' => '18/April/2026 - 20/April/2026',
            'status' => 'ongoing',
            'total_biaya' => 800000
        ]);

        // Data 2: Damar
        Reservation::create([
            'room_type' => 'Suite Room',
            'room_number' => '301',
            'nama_lengkap' => 'Damar Widi Nugroho',
            'whatsapp' => '081122334455',
            'email' => 'damar@polibatam.ac.id',
            'jumlah_tamu' => '2 Person',
            'check_in_out' => '17/April/2026 - 18/April/2026',
            'status' => 'done',
            'total_biaya' => 2500000
        ]);
    }
}