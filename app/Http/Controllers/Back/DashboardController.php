<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Registrasi;
use App\Models\Ruangan;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPendaftar    = Registrasi::count();
        $totalDiverifikasi = Registrasi::where('status', 'approved')->count();

        $terakhirRegistrasi = Registrasi::latest('created_at')->first();
        $terakhirVerifikasi = Registrasi::latest('updated_at')->first();


        $chartRaw = Registrasi::selectRaw("
                CASE
                    WHEN status = 'pending' THEN DATE(created_at)
                    ELSE DATE(updated_at)
                END as tanggal,
                status,
                COUNT(*) as jumlah
            ")
            ->groupBy('tanggal', 'status')
            ->orderBy('tanggal')
            ->get()
            ->groupBy('tanggal');

        $labels   = $chartRaw->keys()->values();
        $pending  = [];
        $approved = [];
        $rejected = [];

        foreach ($chartRaw as $items) {
            $pending[]  = $items->firstWhere('status', 'pending')->jumlah  ?? 0;
            $approved[] = $items->firstWhere('status', 'approved')->jumlah ?? 0;
            $rejected[] = $items->firstWhere('status', 'rejected')->jumlah ?? 0;
        }


        $ruanganKuota = Ruangan::sum('kuota');
        $menuKuota    = Menu::sum('kuota');

        $ruangankuotanowCount = Registrasi::where('status', 'approved')->count();
        $menukuotanowCount = Registrasi::whereIn('status', ['approved', 'pending'])->count();

        $sisaKuotaRuangan = $ruanganKuota - $ruangankuotanowCount;
        $sisaKuotaMenu    = $menuKuota - $menukuotanowCount;

        $kuotaPerRuangan = Ruangan::select(
                'id',
                'menu_id',
                'nama_ruangan as name',
                'kuota',
                DB::raw('COALESCE(kuota_now, 0) as kuota_now')
            )
            ->with('menu:id,short_code')
            ->get();

        $kuotaPerMenu = Menu::select(
                'id',
                'mata_pelajaran as name',
                'short_code',
                'menu_category_id',
                'tingkat',
                'status',
                'kuota',
                DB::raw('COALESCE(kuota_now, 0) as kuota_now')
            )
            ->with('menuCategory:id,name')
            ->get();


        return view('back.dashboard.index', compact(
            'totalPendaftar',
            'totalDiverifikasi',
            'ruanganKuota',
            'menuKuota',
            'sisaKuotaRuangan',
            'sisaKuotaMenu',
            'kuotaPerRuangan',
            'kuotaPerMenu',
            'labels',
            'pending',
            'approved',
            'rejected',
        ))->with([
            'terakhirDiupdateReg' => optional($terakhirRegistrasi)->created_at?->format('Y-m-d H:i') ?? 'N/A',
            'terakhirDiupdateVer' => optional($terakhirVerifikasi)->updated_at?->format('Y-m-d H:i') ?? 'N/A',
        ]);
    }
}
