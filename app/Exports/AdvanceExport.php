<?php

namespace App\Exports;

use App\Models\Registrasi;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AdvanceExport implements WithMultipleSheets
{
    protected $groupBy;

    public function __construct($groupBy)
    {
        $this->groupBy = $groupBy;
    }

    public function sheets(): array
    {
        $sheets = [];
        $data = Registrasi::with(['menu.menuCategory', 'menu.ruangan'])->get();

        $groups = $data->groupBy(function ($item) {
            switch ($this->groupBy) {
                case 'ruangan':
                    return $item->ruangan_id 
                        ? ($item->menu?->ruangan->isEmpty() 
                            ? 'Tanpa Ruangan' 
                            : $item->menu->ruangan->first()->nama_ruangan) 
                        : 'Tanpa Ruangan';
                case 'kategori':
                    return $item->menu?->menuCategory?->name ?? 'Tanpa Kategori';
                case 'mata_pelajaran':
                    return $item->menu?->mata_pelajaran ?? 'Tanpa Event';
                case 'tingkat':
                    return $item->menu?->tingkat ?? 'Tanpa Tingkat';
                case 'status':
                    return $item->status ?? 'Tanpa Status';
                default:
                    return 'Lainnya';
            }
        });

        $sheetNames = [];
        foreach ($groups as $groupName => $items) {
            $cleanSheetName = preg_replace('/[\/?*[\]:]/', '', $groupName);
            
            if (strlen($cleanSheetName) > 31) {
                $cleanSheetName = substr($cleanSheetName, 0, 28) . '...';
            }

            $originalName = $cleanSheetName;
            $counter = 1;
            while (isset($sheetNames[$cleanSheetName])) {
                $cleanSheetName = $originalName . ' (' . $counter . ')';
                $counter++;
            }

            $sheetNames[$cleanSheetName] = true;

            $sheets[] = new RegistrasiSheet($cleanSheetName, $items);
        }

        return $sheets;
    }
}


