<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KamarSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kamar')->insert([
            [
                'tipe_kamar' => 'Deluxe',
                'harga' => 500000,
                'status' => 'tersedia'
            ],
            [
                'tipe_kamar' => 'Suite',
                'harga' => 1000000,
                'status' => 'tersedia'
            ]
        ]);
    }
}