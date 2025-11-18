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
            [
                "volume_tahun_id" => "1",
                "bulan" => 1,
                "organik" => 47,
                "non_organik" => 34,
                "b3" => 10
            ],
            [
                "volume_tahun_id" => "1",
                "bulan" => 2,
                "organik" => 45,
                "non_organik" => 32,
                "b3" => 11
            ],
            [
                "volume_tahun_id" => "1",
                "bulan" => 3,
                "organik" => 49,
                "non_organik" => 35,
                "b3" => 9
            ],
            [
                "volume_tahun_id" => "1",
                "bulan" => 4,
                "organik" => 52,
                "non_organik" => 38,
                "b3" => 10
            ],
            [
                "volume_tahun_id" => "1",
                "bulan" => 5,
                "organik" => 48,
                "non_organik" => 33,
                "b3" => 12
            ],
            [
                "volume_tahun_id" => "1",
                "bulan" => 6,
                "organik" => 50,
                "non_organik" => 36,
                "b3" => 10
            ],
            [
                "volume_tahun_id" => "1",
                "bulan" => 7,
                "organik" => 46,
                "non_organik" => 39,
                "b3" => 11
            ],
            [
                "volume_tahun_id" => "1",
                "bulan" => 8,
                "organik" => 51,
                "non_organik" => 37,
                "b3" => 8
            ],
            [
                "volume_tahun_id" => "1",
                "bulan" => 9,
                "organik" => 49,
                "non_organik" => 35,
                "b3" => 10
            ],
            [
                "volume_tahun_id" => "1",
                "bulan" => 10,
                "organik" => 47,
                "non_organik" => 36,
                "b3" => 11
            ],
            [
                "volume_tahun_id" => "1",
                "bulan" => 11,
                "organik" => 50,
                "non_organik" => 34,
                "b3" => 12
            ],
            [
                "volume_tahun_id" => "1",
                "bulan" => 12,
                "organik" => 55,
                "non_organik" => 40,
                "b3" => 13
            ],

            // RT 03
            [
                "volume_tahun_id" => "3",
                "bulan" => 1,
                "organik" => 30,
                "non_organik" => 35,
                "b3" => 13
            ],
            [
                "volume_tahun_id" => "3",
                "bulan" => 2,
                "organik" => 40,
                "non_organik" => 20,
                "b3" => 8
            ],
            [
                "volume_tahun_id" => "3",
                "bulan" => 3,
                "organik" => 55,
                "non_organik" => 40,
                "b3" => 10
            ],
            [
                "volume_tahun_id" => "3",
                "bulan" => 4,
                "organik" => 40,
                "non_organik" => 43,
                "b3" => 5
            ],
            [
                "volume_tahun_id" => "3",
                "bulan" => 5,
                "organik" => 51,
                "non_organik" => 42,
                "b3" => 10
            ],
            [
                "volume_tahun_id" => "3",
                "bulan" => 6,
                "organik" => 34,
                "non_organik" => 40,
                "b3" => 6
            ],
            [
                "volume_tahun_id" => "3",
                "bulan" => 7,
                "organik" => 20,
                "non_organik" => 32,
                "b3" => 7
            ],
            [
                "volume_tahun_id" => "3",
                "bulan" => 8,
                "organik" => 55,
                "non_organik" => 41,
                "b3" => 13
            ],
            [
                "volume_tahun_id" => "3",
                "bulan" => 9,
                "organik" => 43,
                "non_organik" => 34,
                "b3" => 14
            ],
            [
                "volume_tahun_id" => "3",
                "bulan" => 10,
                "organik" => 55,
                "non_organik" => 40,
                "b3" => 13
            ],
        ]);
    }
}
