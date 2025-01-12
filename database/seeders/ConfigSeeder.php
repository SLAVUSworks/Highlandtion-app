<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Config::insert([
            [
                'name' => 'app_name',
                'value' => 'Highlandtion',
            ],
            [
                'name' => 'app_description',
                'value' => '“Highlandtion” adalah sebuah acara kompetisi yang diadakan oleh OSIS/MPK  SMAN 1 Bukittinggi. Kompetisi ini mencakup bidang akademik dan non-akademik sebagai penyaluran minat, bakat, dan potensi generasi muda khususnya pelajar.',
            ],
            [
                'name' => 'app_favicon',
                'value' => 'favicon.png',
            ],
            [
                'name' => 'header-background',
                'value' => 'header-background.jpg',
            ],
            [
                'name' => 'header-logo-left',
                'value' => 'header-logo-left.png',
            ],
            [
                'name' => 'header-logo-right',
                'value' => 'header-logo-right.png',
            ],
            [
                'name' => 'tagline',
                'value' => 'Ini Tagline',
            ],
            [
                'name' => 'header-typewriter',
                'value' => "Gunakan Syntax typewriter.js atau gunakan teks biasa untuk statis"
            ],
            [
                'name' => 'footer-contact',
                'value' => 'detail kontak',
            ],
            [
                'name' => 'footer-sponsor',
                'value' => '! Gunakan dan sesuaikan jumlah tag ini dengan jumlah sponsor <img src="url gambar" alt="Sponsor" class="mx-auto">',
            ],
            [
                'name' => 'footer-ekskul',
                'value' => '! Gunakan dan sesuaikan jumlah tag ini dengan jumlah ekskul<div><img src="#" alt="ekskul 1" class="mx-auto"></div>',
            ]
        ]);
    }
}
