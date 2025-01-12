<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Registrasi;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;
use App\Models\Menu;
use Barryvdh\DomPDF\Facade\Pdf;

class RegistrasiController extends Controller
{
    public function index()
    {
        $registrasis = Registrasi::with(['menu', 'ruangan']);
        $menus = Menu::all();
    
        return view('back.registrasi.index', compact('registrasis', 'menus'));
    }    
    

    public function getRegistrasiData(Request $request)
    {
        $search = $request->get('search', '');
        $status = $request->get('status', '');
        $menuId = $request->get('menu', '');
    
        $query = Registrasi::with('menu')
            ->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('asal_sekolah', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
    
        if ($status) {
            $query->where('status', $status);
        }
    
        if ($menuId) {
            $query->where('menu_id', $menuId);
        }
        
        $registrasis = $query->get();
    
        return response()->json($registrasis);
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

        $uniqueCode = 'HL-' . $registrasi->created_at->format('dm') . $registrasi->menu_id . $validated['ruangan_id'] . $registrasi->created_at->format('Hi');

        $registrasi->update([
            'ruangan_id' => $validated['ruangan_id'],
            'status' => 'approved',
            'registration_code' => $uniqueCode,
        ]);

        return redirect()->route('back.registrasis.card', $registrasi->id)->with('success', 'Registrasi berhasil diverifikasi.');
    }

    public function showCard($id)
    {
        $registrasi = Registrasi::with(['menu', 'ruangan'])->findOrFail($id);

        return view('back.registrasi.card', compact('registrasi'));
    }

    public function generatePdf($id)
    {
        $registrasi = Registrasi::findOrFail($id);
    
        $htmlContent = view('back.registrasi.pdf', compact('registrasi'))->render();
        
        // Inisialisasi DomPDF
        $pdf = Pdf::loadHTML($htmlContent);
    
        return $pdf->download("Kartu_Registrasi_{$registrasi->registration_code}.pdf");
    }

    public function sendWhatsAppMessage(Registrasi $registrasi)
    {
        $nomorHp = ltrim($registrasi->nomor_hp, '0');
        
        $sid = env('TWILIO_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $twilioNumber = 'whatsapp:' . env('TWILIO_PHONE_NUMBER');
        
        $client = new Client($sid, $authToken);
    
        try {
            $message = $client->messages->create(
                'whatsapp:+62' . $nomorHp,
                [
                    'from' => $twilioNumber,
                    'body' => "Halo, {$registrasi->nama}! Berikut adalah informasi kartu ujian Anda:\n" .
                        "Asal Sekolah: {$registrasi->asal_sekolah}\n" .
                        "Menu: {$registrasi->menu->mata_pelajaran}\n" .
                        "Ruangan: {$registrasi->ruangan->nama_ruangan}\n" .
                        "Nomor Registrasi: {$registrasi->registration_code}"
                ]
            );
        } catch (\Exception $e) {
            Log::error('Error saat mengirim pesan WhatsApp: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim pesan: ' . $e->getMessage());
        }
    
        return redirect()->back()->with('success', 'Pesan berhasil dikirim ke WhatsApp!');
    }    
}


