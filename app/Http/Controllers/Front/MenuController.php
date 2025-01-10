<?php

namespace App\Http\Controllers\Front;

use App\Models\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('front.menu.index', compact('menus'));
    }

    public function show(Menu $menu)
    {
        return view('front.menu.show', compact('menu'));
    }
}