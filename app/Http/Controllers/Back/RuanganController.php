<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::with('menu')->get();
        return view('back.ruangan.index', compact('ruangans'));
    }

    public function create()
    {
        $menus = Menu::all(); // Ambil semua menu untuk dropdown
        return view('back.ruangan.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'required',
            'kuota' => 'required|integer',
            'menu_id' => 'required|exists:menus,id',
        ]);

        Ruangan::create($request->all());
        return redirect()->route('back.ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function edit(Ruangan $ruangan)
    {
        $menus = Menu::all();
        return view('back.ruangan.edit', compact('ruangan', 'menus'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        // Validasi input
        $request->validate([
            'nama_ruangan' => 'required',
            'kuota' => 'required|integer',
            'menu_id' => 'required|exists:menus,id',
        ]);
    
        // Update data
        $ruangan->update($request->all());
    
        return redirect()->route('back.ruangan.index')->with('success', 'Ruangan berhasil diperbarui!');
    }
    

    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();
        return redirect()->route('back.ruangan.index');
    }
}
