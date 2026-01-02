<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Registrasi;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Exports\AdvanceExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function showExportPage()
    {
        $totalPendaftar = Registrasi::count();
        $totalDiverifikasi = Registrasi::where('status', 'approved')->count();
        $pendaftarPertama = Registrasi::orderBy('created_at', 'asc')->first();
        $terakhirDiupdate = Registrasi::orderBy('updated_at', 'desc')->first();
    
        $pendaftarPerTanggal = Registrasi::selectRaw('DATE(created_at) as tanggal, COUNT(*) as jumlah')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();
    
        return view('back.export.index', [
            'totalPendaftar' => $totalPendaftar,
            'totalDiverifikasi' => $totalDiverifikasi,
            'pendaftarPertama' => $pendaftarPertama ? $pendaftarPertama->created_at->format('Y-m-d H:i:s') : 'N/A',
            'terakhirDiupdate' => $terakhirDiupdate ? $terakhirDiupdate->updated_at->format('Y-m-d H:i:s') : 'N/A',
            'pendaftarPerTanggal' => $pendaftarPerTanggal,
        ]);
    }
    
    public function exportCsv(Request $request)
    {
        $columns = $request->query('columns', []);
    
        if (empty($columns)) {
            return back()->with('error', 'Pilih setidaknya satu kolom untuk diekspor.');
        }
    
        array_unshift($columns, 'No');
    
        $columnLabels = [
            'nomor_urut_formatted' => 'Nomor Urut Database',
            'id' => 'ID',
            'nama' => 'Nama',
            'asal_sekolah' => 'Asal Sekolah',
            'nomor_hp' => 'Nomor HP',
            'menu.menu_category.name' => 'Kategori',
            'menu.mata_pelajaran' => 'Event',
            'menu.tingkat' => 'Tingkat',
            'menu.ruangan' => 'Ruangan',
            'status' => 'Status',
            'registration_code' => 'Kode Registrasi',
            'created_at' => 'Didaftarkan',
            'updated_at' => 'Diperbarui',
        ];
    
        $fileName = 'export_data_pendaftar_' . date('Y-m-d_H-i-s') . '.csv';
    
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];
    
        $callback = function () use ($columns, $columnLabels) {
            $file = fopen('php://output', 'w');
    
            fputcsv($file, array_map(fn($col) => $columnLabels[$col] ?? ucfirst(str_replace('_', ' ', $col)), $columns));
    
            $index = 1;
    
            Registrasi::with(['menu.menuCategory', 'menu.ruangan'])->chunk(1000, function ($rows) use ($file, $columns, &$index) {
                foreach ($rows as $row) {
                    $data = [$index++]; 
    
                    foreach ($columns as $column) {
                        if ($column === 'No') continue;
    
                        if (strpos($column, 'menu.') === 0) {
                            $relasiField = str_replace('menu.', '', $column);
    
                            if ($relasiField === 'menu_category.name') {
                                $data[] = $row->menu?->menuCategory?->name ?? '-';
                            } elseif ($relasiField === 'ruangan') {
                                $data[] = $row->ruangan_id ? $row->menu?->ruangan->pluck('nama_ruangan')->implode(', ') : '-';
                            } else {
                                $data[] = $row->menu?->$relasiField ?? '-';
                            }
                        } else {
                            $data[] = $row->$column ?? '-';
                        }
                    }
    
                    fputcsv($file, $data);
                }
            });
    
            fclose($file);
        };
    
        return response()->stream($callback, 200, $headers);
    }
        
    public function advanceExport(Request $request)
    {
        $groupBy = $request->query('groupBy', 'kategori');

        return Excel::download(
            new AdvanceExport($groupBy),
            'advance_export_' . date('Y-m-d_H-i-s') . '.xlsx'
        );
    }
}

