<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nickname' => 'admin',
                'full_name' => 'Administrator',
                'email' => 'administrator@localhost',
                'password' => bcrypt('password'),
                'role' => 1,
                'avatar' => 'avatars/default.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
