<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user terautentikasi dan memiliki role 1
        if (Auth::check() && Auth::user()->role == 1) {
            return $next($request);
        }

        // Jika role tidak sesuai, kirim pesan error ke view
        return response()->view('back.errors.no-access', [], 403);
    }
}