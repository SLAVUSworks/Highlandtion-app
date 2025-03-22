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
                'name' => 'app_status',
                'value' => '1',
            ],
            [
                'name' => 'app_favicon',
                'value' => 'https://github.com/SLAVUSworks/HL-Web-ICON/blob/master/hl2.png?raw=true',
            ],
            [
                'name' => 'header-background',
                'value' => 'https://safebooru.org//images/3092/e4da0905431f44463d193968b91d949ebe41a9cf.jpg',
            ],
            [
                'name' => 'header-logo-left',
                'value' => 'https://github.com/SLAVUSworks/HL-Web-ICON/blob/master/hl2.png?raw=true',
            ],
            [
                'name' => 'header-logo-right',
                'value' => 'https://github.com/SLAVUSworks/HL-Web-ICON/blob/master/smansa.png?raw=true',
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

                    typewriter.typeString('Highlandtion <u style="text-decoration: red underline;">2.1</u>')
                        .pauseFor(2500)
                        .deleteAll()
                        .typeString('<strong>High</strong>')
                        .pauseFor(1000)
                        .deleteAll()
                        .typeString('<strong>Landbouw</strong>')
                        .pauseFor(1000)
                        .deleteAll()
                        .typeString('<strong>Competition</strong>')
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
                'value' => 'default.png',
            ],
        ]);
    }
}
