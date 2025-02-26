<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;
use App\Models\MenuCategory;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('back.menu.index', compact('menus'));
    }

    public function create()
    {
        $menuCategories = MenuCategory::all();
        return view('back.menu.create', compact('menuCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mata_pelajaran' => 'required',
            'tingkat' => 'required',
            'deskripsi' => 'required',
            'menu_category_id' => 'required',
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
            'menu_category_id' => 'required',
            'kuota' => 'required',
            'harga' => 'required',
            'status' => 'required',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $data = $request->only(['mata_pelajaran', 'tingkat', 'deskripsi','menu_category_id','status', 'kuota', 'harga']);
    
        if ($request->hasFile('icon')) {
            if ($menu->icon) {
                Storage::delete('public/' . $menu->icon);
            }
            $data['icon'] = $request->file('icon')->store('icons', 'public');
        }
    
        if ($request->hasFile('thumbnail')) {
            if ($menu->thumbnail) {
                Storage::delete('public/' . $menu->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }
    
        $menu->update($data);
    
        return redirect()->route('back.menu.index')->with('success', 'Menu berhasil diperbarui!');
    }
    
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('back.menu.index');
    }
}
