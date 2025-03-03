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
                'email' => 'slavusworks_davv@w-witch.id',
                'password' => bcrypt('admin'),
                'role' => 1,
                'avatar' => 'avatars/default.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nickname' => 'moderator',
                'full_name' => 'Moderator Sample',
                'email' => 'dummy1@email.com',
                'password' => bcrypt('password1'),
                'role' => 2,
                'avatar' => 'avatars/default.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nickname' => 'verificator',
                'full_name' => 'Verificator Sample',
                'email' => 'dummy2@email.com',
                'password' => bcrypt('password2'),
                'role' => 3,
                'avatar' => 'avatars/default.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
