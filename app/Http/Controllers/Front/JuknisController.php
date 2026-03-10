<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Juknis;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class JuknisController extends Controller
{
    /**
     * Tampilkan daftar juknis untuk user umum.
     */
    public function index()
    {
        $juknis = Juknis::latest()->paginate(12);

        return view('front.juknis.index', compact('juknis'));
    }

    /**
     * Download file PDF juknis.
     */
    public function download(Juknis $juknis): StreamedResponse
    {
        abort_unless(Storage::disk('public')->exists($juknis->file_pdf), 404, 'File tidak ditemukan.');

        return Storage::disk('public')->download(
            $juknis->file_pdf,
            $juknis->nama_file_asli
        );
    }
}