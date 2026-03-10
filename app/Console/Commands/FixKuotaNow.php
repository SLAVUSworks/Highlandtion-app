<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Menu; // Tambahkan import ini

class FixKuotaNow extends Command
{
    protected $signature = 'app:fix-kuota-now';
    protected $description = 'Fix kuota_now semua menu';

    public function handle()
    {
        $menus = Menu::all();

        foreach ($menus as $menu) {
            $menu->updateKuotaNow();
            $this->info("Fixed: {$menu->mata_pelajaran} => kuota_now: {$menu->kuota_now}");
        }

        $this->info('Semua kuota_now berhasil diperbaiki!');
    }
}