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
                'name' => 'footer-contact',
                'value' => 'detail kontak',
            ],
        ]);
    }
}
