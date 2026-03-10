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
        $menus = Menu::with('menuCategory')->get()->map(function ($menu) {
            if ($menu->kuota_now <= 0) {
                $menu->status = 'tutup';
            }
            return $menu;
        });
        
        return view('front.menu.index', compact('menus', 'categories'));
    }

    public function show(Menu $menu)
    {
        if ($menu->kuota_now <= 0) {
            $menu->status = 'tutup';
        }
        
        $category = MenuCategory::all();
        return view('front.menu.show', compact('menu', 'category'));
    }
}