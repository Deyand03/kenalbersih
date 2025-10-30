<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'email' => 'defry@gmail.com',
            'password' => Hash::make('qwerty'),
            'role' => 'rt'
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'email' => 'azia@gmail.com',
            'password' => Hash::make('qwerty'),
            'role' => 'rt'
        ]);
        DB::table('users')->insert([
            'id' => 3,
            'email' => 'raihan@gmail.com',
            'password' => Hash::make('qwerty'),
            'role' => 'rt'
        ]);
    }
}
