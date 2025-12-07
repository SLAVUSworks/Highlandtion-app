<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RegistrasiSheet implements FromCollection, WithTitle, WithHeadings
{
    protected $groupName;
    protected $items;

    public function __construct($groupName, $items)
    {
        $this->groupName = $groupName;
        $this->items = $items;
    }

    public function collection()
    {
        return collect($this->items)->map(function ($item, $index) {
            return [
                'No' => $index + 1,
                'ID' => $item->id,
                'Nama' => $item->nama,
                'Asal Sekolah' => $item->asal_sekolah,
                'Nomor HP' => $item->nomor_hp,
                'Kategori' => $item->menu?->menuCategory?->name ?? '-',
                'Mata Pelajaran' => $item->menu?->mata_pelajaran ?? '-',
                'Tingkat' => $item->menu?->tingkat ?? '-',
                'Ruangan' => $item->menu?->ruangan->isEmpty() ? '-' : $item->menu->ruangan->first()->nama_ruangan,
                'Status' => $item->status,
                'Kode Registrasi' => $item->registration_code,
                'Didaftarkan' => $item->created_at->format('Y-m-d H:i:s'),
                'Diperbarui' => $item->updated_at->format('Y-m-d H:i:s'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No', 'ID', 'Nama', 'Asal Sekolah', 'Nomor HP', 'Kategori', 'Mata Pelajaran',
            'Tingkat', 'Ruangan', 'Status', 'Kode Registrasi', 'Didaftarkan', 'Diperbarui'
        ];
    }

    public function title(): string
    {
        return substr($this->groupName, 0, 31);
    }
}

