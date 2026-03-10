<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\JuknisRequest;
use App\Models\Juknis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JuknisController extends Controller
{
    /**
     * Tampilkan daftar semua juknis.
     */
    public function index()
    {
        $juknis = Juknis::latest()->paginate(20);

        return view('back.juknis.index', compact('juknis'));
    }

    /**
     * Form tambah juknis baru.
     */
    public function create()
    {
        return view('back.juknis.form');
    }

    /**
     * Simpan juknis baru ke database.
     */
    public function store(JuknisRequest $request)
    {
        $file         = $request->file('file_pdf');
        $namaAsli     = $file->getClientOriginalName();
        $namaFile     = Str::uuid() . '.pdf';
        $path         = $file->storeAs('juknis', $namaFile, 'public');

        Juknis::create([
            'nama_event'    => $request->nama_event,
            'keterangan'    => $request->keterangan,
            'file_pdf'      => $path,
            'nama_file_asli'=> $namaAsli,
        ]);

        return redirect()->route('back.juknis.index')
                         ->with('success', 'Juknis berhasil ditambahkan.');
    }

    /**
     * Form edit juknis.
     */
    public function edit(Juknis $juknis)
    {
        return view('back.juknis.form', compact('juknis'));
    }

    /**
     * Update data juknis.
     */
    public function update(JuknisRequest $request, Juknis $juknis)
    {
        $data = [
            'nama_event' => $request->nama_event,
            'keterangan' => $request->keterangan,
        ];

        if ($request->hasFile('file_pdf')) {
            Storage::disk('public')->delete($juknis->file_pdf);

            $file            = $request->file('file_pdf');
            $namaAsli        = $file->getClientOriginalName();
            $namaFile        = Str::uuid() . '.pdf';
            $path            = $file->storeAs('juknis', $namaFile, 'public');

            $data['file_pdf']       = $path;
            $data['nama_file_asli'] = $namaAsli;
        }

        $juknis->update($data);

        return redirect()->route('back.juknis.index')
                         ->with('success', 'Juknis berhasil diperbarui.');
    }

    /**
     * Hapus juknis beserta file PDF-nya.
     */
    public function destroy(Juknis $juknis)
    {
        Storage::disk('public')->delete($juknis->file_pdf);
        $juknis->delete();

        return redirect()->route('back.juknis.index')
                         ->with('success', 'Juknis berhasil dihapus.');
    }
}