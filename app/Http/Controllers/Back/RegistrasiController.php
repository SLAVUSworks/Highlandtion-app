<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Registrasi;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class RegistrasiController extends Controller
{
    public function index()
    {
        $registrasis = Registrasi::with(['menu', 'ruangan'])->get();
        return view('back.registrasi.index', compact('registrasis'));
    }

    public function edit($id)
    {
        $registrasi = Registrasi::findOrFail($id);
        $ruangans = Ruangan::where('menu_id', $registrasi->menu_id)->get();
        return view('back.registrasi.edit', compact('registrasi', 'ruangans'));
    }

    public function store(Request $request)
    {
        $registrasi = Registrasi::create($request->all());
        if ($registrasi->status === 'approved') {
            $registrasi->menu?->updateKuotaNow();
            $registrasi->ruangan?->updateKuotaNow();
        }

        return redirect()->back()->with('success', 'Registrasi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $registrasi = Registrasi::findOrFail($id);

        $validated = $request->validate([
            'ruangan_id' => 'required|exists:ruangans,id',
        ]);

        // Generate a unique registration code
        $uniqueCode = strtoupper(Str::random(8));

        // Update the registration
        $registrasi->update([
            'ruangan_id' => $validated['ruangan_id'],
            'status' => 'approved',
            'registration_code' => $uniqueCode,
        ]);

        return redirect()->route('back.registrasis.index')->with('success', 'Registrasi berhasil diverifikasi.');
    }

    public function showCard($id)
    {
        $registrasi = Registrasi::with(['menu', 'ruangan'])->findOrFail($id);

        return view('back.registrasi.card', compact('registrasi'));
    }

    public function kirimPesan(Registrasi $registrasi)
    {
        // Data untuk pesan
        $nomorHp = $registrasi->nomor_hp;
        $pesan = "Halo {$registrasi->nama},\n\nBerikut adalah detail kartu ujian Anda:\n" .
                 "- Asal Sekolah: {$registrasi->asal_sekolah}\n" .
                 "- Menu: {$registrasi->menu->mata_pelajaran}\n" .
                 "- Ruangan: {$registrasi->ruangan->nama_ruangan}\n" .
                 "- Nomor Registrasi: {$registrasi->registration_code}\n\n" .
                 "Terima kasih!";
    
        // Kirim pesan menggunakan WhatsApp API
        $response = Http::withToken(env('WHATSAPP_API_TOKEN'))
            ->post('https://graph.facebook.com/v17.0/' . env('WHATSAPP_PHONE_NUMBER_ID') . '/messages', [
                'messaging_product' => 'whatsapp',
                'to' => $nomorHp,
                'type' => 'text',
                'text' => [
                    'body' => $pesan,
                ],
            ]);
    
        // Respons berhasil atau gagal
        if ($response->successful()) {
            return redirect()->route('back.registrasis.index')->with('success', 'Pesan berhasil dikirim ke WhatsApp!');
        } else {
            return redirect()->route('back.registrasis.index')->with('error', 'Gagal mengirim pesan: ' . $response->body());
        }
    }
}


