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
                'menus.id',
                'menus.mata_pelajaran as name',
                'menus.short_code',
                'menus.menu_category_id',
                'menus.tingkat',
                'menus.status',
                'menus.kuota',
                DB::raw('COALESCE(menus.kuota_now, 0) as kuota_now'),
                DB::raw("COUNT(CASE WHEN registrasis.status = 'approved' THEN 1 END) as peserta"),
                DB::raw("SUM(CASE WHEN registrasis.status = 'approved' THEN menus.harga ELSE 0 END) as revenue")
            )
            ->leftJoin('registrasis', 'registrasis.menu_id', '=', 'menus.id')
            ->with('menuCategory:id,name')
            ->groupBy(
                'menus.id',
                'menus.mata_pelajaran',
                'menus.short_code',
                'menus.menu_category_id',
                'menus.tingkat',
                'menus.status',
                'menus.kuota',
                'menus.kuota_now'
            )
            ->get();

        $totalRevenue = DB::table('registrasis')
            ->join('menus', 'registrasis.menu_id', '=', 'menus.id')
            ->where('registrasis.status', 'approved')
            ->sum('menus.harga');

        $revenuePending = DB::table('registrasis')
            ->join('menus', 'registrasis.menu_id', '=', 'menus.id')
            ->where('registrasis.status', 'pending')
            ->sum('menus.harga');

        $revenueLast24Hours = DB::table('registrasis')
            ->join('menus', 'registrasis.menu_id', '=', 'menus.id')
            ->where('registrasis.status', 'approved')
            ->where('registrasis.created_at', '>=', now()->subDay())
            ->sum('menus.harga');

        $maxRevenue = DB::table('menus')
            ->select(DB::raw('SUM(harga * kuota) as total'))
            ->value('total');

        $revenuePie = DB::table('registrasis')
            ->join('menus', 'registrasis.menu_id', '=', 'menus.id')
            ->select(
                'registrasis.status',
                DB::raw('SUM(menus.harga) as total')
            )
            ->groupBy('registrasis.status')
            ->pluck('total','status');

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
            'totalRevenue',
            'revenuePending',
            'revenueLast24Hours',
            'maxRevenue',
            'revenuePie'
        ))->with([
            'terakhirDiupdateReg' => optional($terakhirRegistrasi)->created_at?->format('Y-m-d H:i') ?? 'N/A',
            'terakhirDiupdateVer' => optional($terakhirVerifikasi)->updated_at?->format('Y-m-d H:i') ?? 'N/A',
        ]);
    }
}
