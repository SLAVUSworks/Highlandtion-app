<?php

namespace App\Http\Controllers\Front;

use App\Models\Registrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class RegistrasiController extends Controller
{
    public function create()
    {
        return view('registrasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_hp' => 'required|string|max:20',
            'bukti_transfer' => 'required|image|max:2048',
        ]);

        $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        $registrationCode = 'REG-' . strtoupper(Str::random(8));

        $registrasi = Registrasi::create([
            'nama' => $validated['nama'],
            'asal_sekolah' => $validated['asal_sekolah'],
            'email' => $validated['email'],
            'nomor_hp' => $validated['nomor_hp'],
            'bukti_transfer' => $path,
            'registration_code' => $registrationCode,
        ]);

        return redirect()->route('registrasi.card', $registrasi)->with('success', 'Pendaftaran berhasil.');
    }

    public function show(Registrasi $registrasi)
    {
        return view('front.registrasi.card', compact('registrasi'));
    }
}
