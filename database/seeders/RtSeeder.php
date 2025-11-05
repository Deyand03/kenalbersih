<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nama = [
            'Defry',
            'Azia',
            'Raihan'
        ];
        DB::table('rts')->insert([
            [
                "user_id" => 1,
                "no_rt" => 1,
                "nama" => 'Defry',
                "jenis_kelamin" => 'Laki-laki',
                "no_dana" => '08123456781',
                "no_hp" => '08123456781'
            ],
            [
                "user_id" => 2,
                "no_rt" => 2,
                "nama" => 'Azia',
                "jenis_kelamin" => 'Perempuan',
                "no_dana" => '08123456782',
                "no_hp" => '08123456782'
            ],
            [
                "user_id" => 3,
                "no_rt" => 3,
                "nama" => 'Raihan',
                "jenis_kelamin" => 'Laki-laki',
                "no_dana" => '08123456783',
                "no_hp" => '08123456783'
            ]
        ]);
    }
}
