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
            'description' => '<div>
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-20 lg:px-8">
        <div class="max-w-2xl lg:max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">Kontak dan Detail Alamat</h2>
            <p class="mt-4 text-lg text-gray-500">Test</p>
        </div>
        <div class="mt-16 lg:mt-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="rounded-lg overflow-hidden">
                    <iframe
                        src="https://maps.google.com/maps?q=sman%201%20bukittinggi&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        width="100%" height="480" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div>
                    <div class="max-w-full mx-auto rounded-lg overflow-hidden">
                        <div class="px-6 py-4">
                            <h3 class="text-lg font-medium text-gray-900">Alamat</h3>
                            <p class="mt-1 text-gray-600">Jl. Syekh Jamil Jambek No.36, Pakan Kurai, Kec. Guguk
                                Panjang, Kota Bukittinggi, Sumatera Barat 26136</p>
                        </div>
                        <div class="border-t border-gray-200 px-6 py-4">
                            <h3 class="text-lg font-medium text-gray-900">Media Sosial</h3>
                            <a href="https://Link Media Sosial 1" target="_blank"></a><p class="mt-1 text-gray-600">Media Sosial 1</p>
                            <a href="https://Link Media Sosial 2" target="_blank"></a><p class="mt-1 text-gray-600">Media Sosial 2</p>
                            <a href="https://Link Media Sosial 3" target="_blank"></a><p class="mt-1 text-gray-600">Media Sosial 3</p>
                        </div>
                        <div class="border-t border-gray-200 px-6 py-4">
                            <h3 class="text-lg font-medium text-gray-900">Kontak</h3>
                            <p class="mt-1 text-gray-600">Email: info@example.com</p>
                            <p class="mt-1 text-gray-600">WA 1: 08123456789</p>
                            <p class="mt-1 text-gray-600">WA 2: 08123456789</p>
                            <p class="mt-1 text-gray-600">WA 3: 08123456789</p>
                            <p class="mt-1 text-gray-600">WA 4: 08123456789</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>',
        ]);
    }
}
