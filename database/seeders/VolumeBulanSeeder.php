<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VolumeBulanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('volume_sampah_bulans')->insert([
            "volume_tahun_id" => "1",
            "bulan" => 1,
            "organik" => 47,
            "non_organik" => 34,
            "b3" => 10
        ]);
    }
}
