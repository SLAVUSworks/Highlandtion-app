<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

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
            'harga' => 'required',
            'kuota' => 'required',
        ]);

        Menu::create($request->all());

        return redirect()->route('back.menu.index');
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
            'harga' => 'required',
            'kuota' => 'required',
        ]);

        $menu->update($request->all());

        return redirect()->route('back.menu.index');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('back.menu.index');
    }
}
