<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Registrasi;

class RegistrasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        $names = [
            'Slava Slavus', 'Abdurrahman Agha Rabbani', 'John Doe',
            'Jane Smith', 'Michael Johnson', 'Emily Davis',
            'Chris Brown', 'Sarah Wilson', 'David Lee', 'Anna Martinez'
        ];

        $schools = [
            'SMAN 1 BUKITTINGGI', 'SMAN 2 JAKARTA', 'SMAN 3 BANDUNG',
            'SMAN 4 SURABAYA', 'SMAN 5 SEMARANG', 'SMAN 6 YOGYAKARTA'
        ];

        // rentang tanggal: 14 hari terakhir
        $startDate = now()->subDays(14);
        $endDate   = now();

        for ($i = 1; $i <= 100; $i++) {

            // created_at random antara start - end
            $createdAt = Carbon::createFromTimestamp(
                rand($startDate->timestamp, $endDate->timestamp)
            );

            // updated_at selalu setelah created_at (0–3 hari)
            $updatedAt = (clone $createdAt)->addMinutes(rand(10, 4320));

            Registrasi::create([
                'nama' => $names[array_rand($names)],
                'asal_sekolah' => $schools[array_rand($schools)],
                'email' => Str::lower(Str::random(10)) . '@gmail.com',
                'nomor_hp' => '08' . rand(1000000000, 9999999999),
                'bukti_transfer' => 'bukti_transfer/pending/' . Str::random(30) . '.jpg',
                'menu_id' => 1,
                'ruangan_id' => null,
                'status' => 'pending',
                'registration_code' => null,
                'is_notified' => false,
                'note' => null,
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);
        }
    }
}



