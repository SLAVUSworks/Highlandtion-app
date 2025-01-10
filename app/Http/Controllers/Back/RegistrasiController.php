<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Registrasi;
use App\Models\Ruangan;
use Illuminate\Http\Request;
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
}


