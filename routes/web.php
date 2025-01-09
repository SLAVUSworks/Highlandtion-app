<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Back\MenuController;
use App\Http\Controllers\Back\RuanganController;



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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('back')->name('back.')->group(function () {
    Route::resource('menu', MenuController::class);
});

Route::prefix('back')->name('back.')->group(function () {
    Route::resource('ruangan', RuanganController::class);
});