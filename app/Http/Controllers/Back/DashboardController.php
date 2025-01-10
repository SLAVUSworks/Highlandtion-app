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
        // Data fetching logic for displaying in the view
        $ruanganKuota = Ruangan::sum('kuota');
        $menuKuota = Menu::sum('kuota');
        $kuotaPerRuangan = Ruangan::select('id', 'nama_ruangan as name', 'kuota')->get();
        $kuotaPerMenu = Menu::select('id', 'mata_pelajaran as name', 'tingkat', 'kuota')->get();
        $tingkatPerMenu = Menu::select('id', 'tingkat')->get();
    
        return view('back.dashboard.index', [
            'ruanganKuota' => $ruanganKuota,
            'menuKuota' => $menuKuota,
            'kuotaPerRuangan' => $kuotaPerRuangan,
            'kuotaPerMenu' => $kuotaPerMenu,
        ]);
    }
    
    public function fetchKuotaData()
    {
        // Same data fetching logic for API response
        $ruanganKuota = Ruangan::sum('kuota');
        $menuKuota = Menu::sum('kuota');
        $kuotaPerRuangan = Ruangan::select('id', 'nama_ruangan as name', 'kuota')->get();
        $kuotaPerMenu = Menu::select('id', 'mata_pelajaran as name', 'kuota')->get();
    
        // Return data as JSON
        return response()->json([
            'ruangan_kuota' => $ruanganKuota,
            'menu_kuota' => $menuKuota,
            'kuota_per_ruangan' => $kuotaPerRuangan,
            'kuota_per_menu' => $kuotaPerMenu,
        ]);
    }
    
}
