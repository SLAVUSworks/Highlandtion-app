<?php

namespace App\Http\Controllers\Front;

use App\Models\Menu;
use App\Models\Registrasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrasiController extends Controller
{
    public function create(Menu $menu)
    {
        return view('front.registrasi.create', compact('menu'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_hp' => 'required|string|max:20',
            'bukti_transfer' => 'required|image|max:2048',
            'menu_id' => 'required|exists:menus,id',
        ]);

        $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');

        Registrasi::create([
            'nama' => $validated['nama'],
            'asal_sekolah' => $validated['asal_sekolah'],
            'email' => $validated['email'],
            'nomor_hp' => $validated['nomor_hp'],
            'bukti_transfer' => $path,
            'menu_id' => $validated['menu_id'],
        ]);

        return redirect()->route('menu.index')->with('success', 'Pendaftaran berhasil, menunggu verifikasi.');
    }
}