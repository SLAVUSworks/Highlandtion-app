<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    /**
     * Count all kuota for Ruangan and Menu.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index()
    {
        $ruanganKuota = Ruangan::sum('kuota');
        $menuKuota = Menu::sum('kuota');
        $sisaKuotaRuangan = Ruangan::sum('kuota') - DB::table('registrasis')->where('status', 'approved')->count('ruangan_id');
        $sisaKuotaMenu = Menu::sum('kuota') - DB::table('registrasis')->where('status', 'approved')->count('menu_id');
        $kuotaPerRuangan = Ruangan::select('id', 'nama_ruangan as name', 'kuota', 'kuota_now')->get()->map(function ($item) {
            if ($item->kuota_now == null) {
                $item->kuota_now = $item->kuota;
            }
            return $item;
        });
        $kuotaPerMenu = Menu::select('id', 'mata_pelajaran as name', 'tingkat', 'kuota', 'kuota_now')->get()->map(function ($item) {
            if ($item->kuota_now == null) {
                $item->kuota_now = $item->kuota;
            }
            return $item;
        });
    
        return view('back.dashboard.index', [
            'ruanganKuota' => $ruanganKuota,
            'menuKuota' => $menuKuota,
            'sisaKuotaRuangan' => $sisaKuotaRuangan,
            'sisaKuotaMenu' => $sisaKuotaMenu,
            'kuotaPerRuangan' => $kuotaPerRuangan,
            'kuotaPerMenu' => $kuotaPerMenu,
        ]);
    }    
}
