<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuCategory;
use Illuminate\Support\Facades\Storage;

class MenuCategoryController extends Controller
{
    public function index()
    {
        $menuCategories = MenuCategory::all();
        return view('back.menu-category.index', compact('menuCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $recentEntry = MenuCategory::where('name', $request->name)
            ->where('created_at', '>=', now()->subSeconds(2))
            ->first();
    
        if ($recentEntry) {
            return back()->with('error', 'Kategori ini baru saja ditambahkan!');
        }
    
        $iconPath = $request->file('icon')->store('menu-icons', 'public');
    
        MenuCategory::create([
            'name' => $request->name,
            'icon' => $iconPath,
        ]);
    
        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }
    

    public function update(Request $request, $id)
    {
        $category = MenuCategory::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('icon')) {
            Storage::delete('public/' . $category->icon);
            $iconPath = $request->file('icon')->store('menu-icons', 'public');
            $category->icon = $iconPath;
        }
    
        $category->name = $request->name;
        $category->save();
    
        return redirect()->back()->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $menuCategory = MenuCategory::findOrFail($id);
        $menuCategory->delete();
        return redirect()->route('back.menu-category.index')->with('success', 'Menu Kategori Berhasil Dihapus!');
    }
}
