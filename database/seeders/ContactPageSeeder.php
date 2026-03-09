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
            'description' => '
            <div class="min-h-screen px-4 py-10">
    <div class="max-w-5xl mx-auto space-y-10">

        <!-- Header -->
        <div class="text-center space-y-2" data-aos="fade-up">
            <span class="inline-block px-4 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider">
                Kontak
            </span>

            <h1 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white">
                Kontak dan Detail Alamat
            </h1>

            <p class="text-slate-400 text-sm max-w-md mx-auto">
                Hubungi kami jika ada pertanyaan atau hal yang ingin disampaikan.
            </p>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6" data-aos="fade-up">

            <!-- Google Maps -->
            <div class="rounded-3xl border border-primary/10 overflow-hidden shadow-xl h-full min-h-[320px]">
                <iframe
                    src="https://maps.google.com/maps?q=sman%201%20bukittinggi&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    width="100%"
                    height="100%"
                    style="border:0; min-height:320px;"
                    loading="lazy"
                    allowfullscreen>
                </iframe>
            </div>

            <!-- Info Box -->
            <div class="rounded-3xl border border-primary/10 bg-white dark:bg-slate-900 shadow-xl overflow-hidden divide-y divide-slate-100 dark:divide-slate-800">

                <!-- Alamat -->
                <div class="px-6 py-5 space-y-2">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="material-symbols-outlined text-primary text-base">location_on</span>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Alamat</p>
                    </div>

                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-300 leading-relaxed">
                        Jl. Syekh Jamil Jambek No.36, Pakan Kurai, Kec. Guguk Panjang,
                        Kota Bukittinggi, Sumatera Barat 26136
                    </p>
                </div>

                <!-- Media Sosial -->
                <div class="px-6 py-5 space-y-3">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="material-symbols-outlined text-primary text-base">alternate_email</span>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Media Sosial</p>
                    </div>

                    <a href="https://Link Media Sosial 1" target="_blank"
                        class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-transparent hover:border-primary/20 hover:bg-primary/5 transition-colors group">
                        <span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors text-base">public</span>
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-300 group-hover:text-primary transition-colors">
                            Media Sosial 1
                        </span>
                        <span class="material-symbols-outlined text-slate-300 group-hover:text-primary ml-auto text-base transition-colors">
                            arrow_forward
                        </span>
                    </a>

                    <a href="https://Link Media Sosial 2" target="_blank"
                        class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-transparent hover:border-primary/20 hover:bg-primary/5 transition-colors group">
                        <span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors text-base">public</span>
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-300 group-hover:text-primary transition-colors">
                            Media Sosial 2
                        </span>
                        <span class="material-symbols-outlined text-slate-300 group-hover:text-primary ml-auto text-base transition-colors">
                            arrow_forward
                        </span>
                    </a>

                    <a href="https://Link Media Sosial 3" target="_blank"
                        class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-transparent hover:border-primary/20 hover:bg-primary/5 transition-colors group">
                        <span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors text-base">public</span>
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-300 group-hover:text-primary transition-colors">
                            Media Sosial 3
                        </span>
                        <span class="material-symbols-outlined text-slate-300 group-hover:text-primary ml-auto text-base transition-colors">
                            arrow_forward
                        </span>
                    </a>
                </div>

                <!-- Kontak -->
                <div class="px-6 py-5 space-y-3">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="material-symbols-outlined text-primary text-base">contacts</span>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Kontak</p>
                    </div>

                    <!-- Email -->
                    <a href="mailto:info@example.com"
                        class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-transparent hover:border-primary/20 hover:bg-primary/5 transition-colors group">
                        <span class="material-symbols-outlined text-primary/60 group-hover:text-primary transition-colors text-base">
                            mail
                        </span>
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">
                            info@example.com
                        </span>
                    </a>

                    <!-- WhatsApp 1 -->
                    <a href="https://wa.me/8123123123123" target="_blank"
                        class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-transparent hover:border-green-500/20 hover:bg-green-500/5 transition-colors group">
                        <span class="material-symbols-outlined text-green-500/60 group-hover:text-green-500 transition-colors text-base">
                            phone
                        </span>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mb-0.5">Ijal</p>
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">08123123123123</p>
                        </div>
                        <span class="text-xs font-bold text-green-500 opacity-0 group-hover:opacity-100 transition-opacity">
                            Chat
                        </span>
                    </a>

                    <!-- WhatsApp 2 -->
                    <a href="https://wa.me/8123123123123" target="_blank"
                        class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-transparent hover:border-green-500/20 hover:bg-green-500/5 transition-colors group">
                        <span class="material-symbols-outlined text-green-500/60 group-hover:text-green-500 transition-colors text-base">
                            phone
                        </span>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mb-0.5">Slapus</p>
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">08123123123123</p>
                        </div>
                        <span class="text-xs font-bold text-green-500 opacity-0 group-hover:opacity-100 transition-opacity">
                            Chat
                        </span>
                    </a>

                    <!-- WhatsApp 3 -->
                    <a href="https://wa.me/8123123123123" target="_blank"
                        class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-transparent hover:border-green-500/20 hover:bg-green-500/5 transition-colors group">
                        <span class="material-symbols-outlined text-green-500/60 group-hover:text-green-500 transition-colors text-base">
                            phone
                        </span>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mb-0.5">Bakwan Jagung</p>
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">08123123123123</p>
                        </div>
                        <span class="text-xs font-bold text-green-500 opacity-0 group-hover:opacity-100 transition-opacity">
                            Chat
                        </span>
                    </a>

                </div>
            </div>
        </div>

        <!-- Back Button -->
        <a href="/"
            class="flex items-center justify-center gap-2 text-sm font-semibold text-slate-400 hover:text-primary transition-colors py-2">
            <span class="material-symbols-outlined text-base">arrow_back</span>
            Kembali ke daftar acara
        </a>

    </div>
</div>
            ',
        ]);
    }
}
