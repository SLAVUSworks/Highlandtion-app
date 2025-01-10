<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\Menu;

class DashboardController extends Controller
{
    /**
     * Count all kuota for Ruangan and Menu.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $ruanganKuota = Ruangan::sum('kuota');
        $menuKuota = Menu::sum('kuota');
        $sisaKuotaRuangan = Ruangan::sum('kuota_now');
        $sisaKuotaMenu = Menu::sum('kuota_now');
        $kuotaPerRuangan = Ruangan::select('id', 'nama_ruangan as name', 'kuota', 'kuota_now')->get();
        $kuotaPerMenu = Menu::select('id', 'mata_pelajaran as name', 'tingkat', 'kuota', 'kuota_now')->get();
    
        return view('back.dashboard.index', [
            'ruanganKuota' => $ruanganKuota,
            'menuKuota' => $menuKuota,
            'sisaKuotaRuangan' => $sisaKuotaRuangan,
            'sisaKuotaMenu' => $sisaKuotaMenu,
            'kuotaPerRuangan' => $kuotaPerRuangan,
            'kuotaPerMenu' => $kuotaPerMenu,
        ]);
    }
    
    public function fetchKuotaData()
    {
        $ruanganKuota = Ruangan::sum('kuota');
        $menuKuota = Menu::sum('kuota');
        $sisaKuotaRuangan = Ruangan::sum('kuota_now');
        $sisaKuotaMenu = Menu::sum('kuota_now');
        $kuotaPerRuangan = Ruangan::select('id', 'nama_ruangan as name', 'kuota', 'kuota_now')->get();
        $kuotaPerMenu = Menu::select('id', 'mata_pelajaran as name', 'tingkat', 'kuota', 'kuota_now')->get();
    
        return response()->json([
            'ruangan_kuota' => $ruanganKuota,
            'menu_kuota' => $menuKuota,
            'kuota_per_ruangan' => $kuotaPerRuangan,
            'kuota_per_menu' => $kuotaPerMenu,
            'ruanganKuota' => $ruanganKuota,
            'menuKuota' => $menuKuota,
            'sisaKuotaRuangan' => $sisaKuotaRuangan,
            'sisaKuotaMenu' => $sisaKuotaMenu,
            'kuotaPerRuangan' => $kuotaPerRuangan,
            'kuotaPerMenu' => $kuotaPerMenu,
        ]);
    }
    
}
