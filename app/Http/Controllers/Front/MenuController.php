<?php

namespace App\Http\Controllers\Front;

use App\Models\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuCategory;

class MenuController extends Controller
{
    public function index()
    {
        $categories = MenuCategory::all();
        $menus = Menu::with('menuCategory')->get();
         
        return view('front.menu.index', compact('menus', 'categories'));
    }

    public function show(Menu $menu)
    {
        return view('front.menu.show', compact('menu'));
    }
}