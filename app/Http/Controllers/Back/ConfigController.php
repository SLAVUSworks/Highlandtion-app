<?php

namespace App\Http\Controllers\Back;

use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
public function index()
{
    return view('back.config.index', [
        'configs' => Config::whereIn('name', [
            'app_name', 'app_description', 'app_status', 'app_favicon',
            'header-background', 'header-logo-left', 'header-logo-right',
            'tagline', 'typewriter', 'footer-contact',
            'nama-bank', 'nomor-rekening', 'nama-pemilik-rekening', 'logo-bank'
        ])->get()->keyBy('name')
    ]);
}

public function update(Request $request)
{
    $data = $request->validate([
        'app_name'               => 'required|string|min:3',
        'app_description'        => 'nullable|string',
        'app_status'             => 'required|in:0,1,2',
        'app_favicon'            => 'nullable|url',
        'header-background'      => 'nullable|url',
        'header-logo-left'       => 'nullable|url',
        'header-logo-right'      => 'nullable|url',
        'tagline'                => 'nullable|string',
        'typewriter'             => 'nullable|string',
        'footer-contact'         => 'nullable|string',
        'nama-bank'              => 'nullable|string',
        'nomor-rekening'         => 'nullable|string',
        'nama-pemilik-rekening'  => 'nullable|string',
        'logo-bank'              => 'nullable|url',
    ]);

    foreach ($data as $key => $value) {
        Config::where('name', $key)->update(['value' => $value]);
    }

    return back()->with('success', 'Pengaturan berhasil diperbarui');
}

}

