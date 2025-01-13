<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactPage;

class ContactPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactPage::create([
            'title' => 'Kontak Kami',
            'description' => 'Silakan hubungi kami di nomor berikut untuk pertanyaan lebih lanjut.',
        ]);
    }
}
