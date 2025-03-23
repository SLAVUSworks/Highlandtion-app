<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Registrasi;

class RegistrasiSeeder extends Seeder
{
    public function run()
    {
        $names = ['Slava Slavus', 'Abdurrahman Agha Rabbani', 'John Doe', 'Jane Smith', 'Michael Johnson', 'Emily Davis', 'Chris Brown', 'Sarah Wilson', 'David Lee', 'Anna Martinez'];
        $schools = ['SMAN 1 BUKITTINGGI', 'SMAN 2 JAKARTA', 'SMAN 3 BANDUNG', 'SMAN 4 SURABAYA', 'SMAN 5 SEMARANG', 'SMAN 6 YOGYAKARTA'];

        for ($i = 1; $i <= 100; $i++) {
            Registrasi::create([
                'nama' => $names[array_rand($names)],
                'asal_sekolah' => $schools[array_rand($schools)],
                'email' => Str::lower(Str::random(10)) . '@gmail.com',
                'nomor_hp' => '08' . rand(1000000000, 9999999999),
                'bukti_transfer' => 'bukti_transfer/pending/' . Str::random(30) . '.jpg',
                'menu_id' => rand(1, 11),
                'ruangan_id' => null,
                'status' => 'pending',
                'registration_code' => null,
                'is_notified' => 0,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}


