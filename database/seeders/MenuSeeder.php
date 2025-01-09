<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus') -> insert ([
            [
                'mata_pelajaran' => 'Matematika',
                'tingkat' => 'SD',
                'deskripsi' => 'Pelajaran Matematika untuk Sekolah Dasar',
                'harga' => 100000,
                'kuota' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran' => 'Matematika',
                'tingkat' => 'SMP/MTs',
                'deskripsi' => 'Pelajaran Matematika untuk Sekolah Menengah Pertama/Madrasah Tsanawiyah',
                'harga' => 150000,
                'kuota' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran' => 'Matematika',
                'tingkat' => 'SMA/MA',
                'deskripsi' => 'Pelajaran Matematika untuk Sekolah Menengah Atas/Madrasah Aliyah',
                'harga' => 200000,
                'kuota' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran' => 'Bahasa Indonesia',
                'tingkat' => 'SD',
                'deskripsi' => 'Pelajaran Bahasa Indonesia untuk Sekolah Dasar',
                'harga' => 100000,
                'kuota' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran' => 'Bahasa Indonesia',
                'tingkat' => 'SMP/MTs',
                'deskripsi' => 'Pelajaran Bahasa Indonesia untuk Sekolah Menengah Pertama/Madrasah Tsanawiyah',
                'harga' => 150000,
                'kuota' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran' => 'Bahasa Indonesia',
                'tingkat' => 'SMA/MA',
                'deskripsi' => 'Pelajaran Bahasa Indonesia untuk Sekolah Menengah Atas/Madrasah Aliyah',
                'harga' => 200000,
                'kuota' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran' => 'Bahasa Inggris',
                'tingkat' => 'SD',
                'deskripsi' => 'Pelajaran Bahasa Inggris untuk Sekolah Dasar',
                'harga' => 100000,
                'kuota' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
