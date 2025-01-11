<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\MenuController;
use App\Http\Controllers\Back\RuanganController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Back\ConfigController;
use App\Http\Controllers\Back\RegistrasiController as BackRegistrasiController;

use App\Http\Controllers\Front\MenuController as FrontMenuController;
use App\Http\Controllers\Front\RegistrasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontMenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{menu}', [FrontMenuController::class, 'show'])->name('menu.show');
Route::get('/registrasi/{menu}', [RegistrasiController::class, 'create'])->name('registrasi.create');
Route::post('/registrasi', [RegistrasiController::class, 'store'])->name('registrasi.store');


Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        if (Auth::check()) {
            return redirect('/back/dashboard');
        }
        return redirect('/login');
    });
    
    Route::prefix('back')->name('back.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    });
    

    Route::prefix('back')->name('back.')->group(function () {
        Route::resource('menu', MenuController::class);
    });
    
    Route::prefix('back')->name('back.')->group(function () {
        Route::resource('ruangan', RuanganController::class);
    });

    Route::prefix('back')->name('back.')->group(function () {
        Route::resource('users', UserController::class);
        Route::get('/profile', [UserController::class, 'show']);
    });

    Route::prefix('back')->name('back.')->group(function () {
        Route::resource('/config', ConfigController::class)->only([
            'index', 'update'
        ]);
    });

    Route::prefix('back')->name('back.')->group(function () {
        Route::get('registrasis', [BackRegistrasiController::class, 'index'])->name('registrasis.index');
        Route::get('registrasis/{registrasi}/edit', [BackRegistrasiController::class, 'edit'])->name('registrasis.edit');
        Route::put('registrasis/{registrasi}', [BackRegistrasiController::class, 'update'])->name('registrasis.update');
        Route::get('registrasis/{registrasi}/card', [BackRegistrasiController::class, 'showCard'])->name('registrasis.card');
        Route::get('registrasis/{registrasi}/kirim-pesan-whatsapp', [BackRegistrasiController::class, 'sendWhatsAppMessage'])->name('registrasis.kirimPesan');

        Route::get('/registrasi-data', [BackRegistrasiController::class, 'getRegistrasiData']);
    });
    
     
    Route::get('back/storage/{path}', function ($path) {
        return response()->file(storage_path('app/public/' . $path));
    })->where('path', '.*');
    
});
Auth::routes();
