<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Registrasi;
use Illuminate\Support\Facades\Response;

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
    

    public function exportCsv()
    {
        $fileName = 'registrasi_data.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'ID',
                'Nama',
                'Asal Sekolah',
                'Nomor HP',
                'Mata Pelajaran',
                'Tingkat',
                'Status',
                'Kode Registrasi',
                'Didaftarkan',
                'Diperbarui'
            ]);

            Registrasi::with('menu')->chunk(1000, function ($rows) use ($file) {
                foreach ($rows as $row) {
                    fputcsv($file, [
                        $row->id,
                        $row->nama,
                        $row->asal_sekolah,
                        '"' . $row->nomor_hp . '"',
                        $row->menu->mata_pelajaran ?? '-',
                        $row->menu->tingkat ?? '-',
                        $row->status,
                        $row->registration_code ?? '-',
                        $row->created_at,
                        $row->updated_at ?? '-'
                    ]);
                }
            });

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}

