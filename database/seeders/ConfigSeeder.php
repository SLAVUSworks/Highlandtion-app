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
                'value' => 'SLAVUSworks',
            ],
            [
                'name' => 'app_description',
                'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptates.',
            ],
            [
                'name' => 'app_status',
                'value' => '0',
            ],
            [
                'name' => 'app_favicon',
                'value' => 'https://inilink.localhost/gambar.png',
            ],
            [
                'name' => 'header-background',
                'value' => 'https://inilink.localhost/gambar.png',
            ],
            [
                'name' => 'tagline',
                'value' => 'Ini Tagline',
            ],
            [
                'name' => 'typewriter',
                'value' => <<<HTML
                <script>
                    var app = document.getElementById('app');

                    var typewriter = new Typewriter(app, {
                        loop: true
                    });

                    typewriter
                        .typeString('SLAVUSworks')
                        .pauseFor(2500)
                        .deleteAll()
                        .typeString('<strong>SLAVUS</strong>')
                        .pauseFor(1000)
                        .deleteAll()
                        .typeString('<strong>works</strong>')
                        .pauseFor(1000)
                        .deleteAll()
                        .typeString('<strong>Test 1234</strong>')
                        .pauseFor(1000)
                        .start();
                </script>
                HTML,
            ],
            [
                'name' => 'footer-contact',
                'value' => 'detail kontak',
            ],
            [
                'name' => 'nama-bank',
                'value' => 'BANK ABCD',
            ],
            [
                'name' => 'nomor-rekening',
                'value' => '123456789',
            ],
            [
                'name' => 'nama-pemilik-rekening',
                'value' => 'a/n SLAVUS',
            ],
            [
                'name' => 'logo-bank',
                'value' => 'https://inilink.localhost/gambar.png',
            ],
            [
                'name' => 'primary',
                'value' => '#ec1b22',
            ],
            [
                'name' => 'primary-dark',
                'value' => '#a52115',
            ],
            [
                'name' => 'primary-muted',
                'value' => '#a9433a',
            ],
             [
                'name' => 'primary-deep',
                'value' => '#8f3c39',
            ],
            [
                'name' => 'primary-light',
                'value' => '#ff595d',
            ],    
        ]);
    }
}
