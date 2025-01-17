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

        $reg = Registrasi::where('nama', $request->nama)
            ->where('email', $request->email)
            ->first();
    
    if ($reg) {
        return redirect()->back()->with(
            'error', 
            $request->nama . ' dengan email ' . $request->email . ' asal sekolah ' . $reg->asal_sekolah . 
            ' sudah terdaftar di ' . $reg->menu->mata_pelajaran . ' - ' . $reg->menu->tingkat . 
            '. Jika merasa belum pernah mendaftar silahkan hubungi panitia.'
        );
    }
    
        $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');

        $registrasi = Registrasi::create([
            'nama' => $validated['nama'],
            'asal_sekolah' => $validated['asal_sekolah'],
            'email' => $validated['email'],
            'nomor_hp' => $validated['nomor_hp'],
            'bukti_transfer' => $path,
            'menu_id' => $validated['menu_id'],
        ]);

        return redirect()->route('registrasi.card', $registrasi)->with('success', 'Pendaftaran berhasil, menunggu verifikasi.');
        
    }

    public function show(Registrasi $registrasi)
    {
        return view('front.registrasi.card', compact('registrasi'));
    }
}