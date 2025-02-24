<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('back.menu.index', compact('menus'));
    }

    public function create()
    {
        return view('back.menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mata_pelajaran' => 'required',
            'tingkat' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $data = $request->all();
    
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('icons', 'public');
        }
    
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }
    
        Menu::create($data);
        
    
        return redirect()->route('back.menu.index')->with('success', 'Menu berhasil dibuat!');
    }

    public function edit(Menu $menu)
    {
        return view('back.menu.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'mata_pelajaran' => 'required',
            'tingkat' => 'required',
            'deskripsi' => 'required',
            'kuota' => 'required',
            'harga' => 'required',
            'status' => 'required',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Ambil data input lainnya
        $data = $request->only(['mata_pelajaran', 'tingkat', 'deskripsi','status', 'kuota', 'harga']);
    
        // Proses file icon jika diupload
        if ($request->hasFile('icon')) {
            // Hapus icon lama jika ada
            if ($menu->icon) {
                Storage::delete('public/' . $menu->icon);
            }
            // Simpan file baru
            $data['icon'] = $request->file('icon')->store('icons', 'public');
        }
    
        // Proses file thumbnail jika diupload
        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($menu->thumbnail) {
                Storage::delete('public/' . $menu->thumbnail);
            }
            // Simpan file baru
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }
    
        // Update data menu
        $menu->update($data);
    
        return redirect()->route('back.menu.index')->with('success', 'Menu berhasil diperbarui!');
    }
    
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('back.menu.index');
    }
}
