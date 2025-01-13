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
                'password' => bcrypt('$2y$12$MjrKcoMUYekhMy0bet6LJ.5H44e5TKAJlKpQ9di4ATCC5iSa0bpXi'),
                'role' => 1,
                'avatar' => 'avatars/default.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nickname' => 'temp_a',
                'full_name' => 'Temporary Account 1',
                'email' => 'dummy1@email.com',
                'password' => bcrypt('password1'),
                'role' => 2,
                'avatar' => 'avatars/default.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nickname' => 'temp_b',
                'full_name' => 'Temporary Account 2',
                'email' => 'dummy2@email.com',
                'password' => bcrypt('password2'),
                'role' => 2,
                'avatar' => 'avatars/default.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
