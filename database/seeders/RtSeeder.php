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
        for ($i=1; $i < count($nama); $i++) {
            DB::table('rts')->insert([
                "user_id" => $i,
                "no_rt" => 12,
                "nama" => $nama[$i - 1],
                "jenis_kelamin" => "Laki-laki",
                "no_dana" => "0812345678$i",
                "no_hp" => "0812345678$i"
            ]);
        }
    }
}
