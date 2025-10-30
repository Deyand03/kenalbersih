<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VolumeTahunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('volume_sampah_tahuns')->insert([
            "id" => 1,
            "rt_id" => 1,
            "tahun" => 2024,
        ]);
    }
}
