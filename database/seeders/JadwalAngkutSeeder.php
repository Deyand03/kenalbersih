<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalAngkutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jadwal_angkuts')->insert([
            [
                'rt_id' => 1,
                'jadwal' => '2025-11-01',
                'status' => 'Belum Diangkut',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rt_id' => 2,
                'jadwal' => '2025-11-02',
                'status' => 'Belum Diangkut',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rt_id' => 3,
                'jadwal' => '2025-11-03',
                'status' => 'Belum Diangkut',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
