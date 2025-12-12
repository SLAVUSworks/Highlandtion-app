<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\MenuController;
use App\Http\Controllers\Back\MenuCategoryController;
use App\Http\Controllers\Back\RuanganController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Back\ConfigController;
use App\Http\Controllers\Back\RegistrasiController as BackRegistrasiController;
use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\ContactPageController;
use App\Http\Controllers\Back\ExportController;
use App\Http\Controllers\Back\ServerStatsController;
use App\Http\Controllers\Back\DataResetController;

use App\Http\Controllers\Front\ArticleController as FrontArticleController;
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

Route::get('.env', function () {
    return redirect('https://youtu.be/dQw4w9WgXcQ?si=UggPYhVqC1PPvszv');
});

Route::get('/', [FrontMenuController::class, 'index'])->name('menu.index');

Route::get('/menu/{menu}', [FrontMenuController::class, 'show'])->name('menu.show');

Route::get('/registrasi/{menu}', [RegistrasiController::class, 'create'])->name('registrasi.create');
Route::post('/registrasi', [RegistrasiController::class, 'store'])->name('registrasi.store');
Route::get('/registrasi/{registrasi}/card', [RegistrasiController::class, 'show'])->name('registrasi.card'); 
Route::get('/track', [RegistrasiController::class, 'trackForm'])->name('registrasi.trackForm');
Route::post('/track', [RegistrasiController::class, 'track'])->name('registrasi.track');

Route::prefix('informasi')->name('front.articles.')->group(function () {
    Route::get('/', [FrontArticleController::class, 'index'])->name('index');
    Route::get('/{slug}', [FrontArticleController::class, 'show'])->name('show');
});

Route::get('/contact', [ContactPageController::class, 'show'])->name('contact.show');

Route::get('/registrasi/{id}/pdf', [BackRegistrasiController::class, 'generatePdf'])->name('registrasis.pdf');

Route::get('/maintenance', function () {return view('front.maintenance.index');})->name('maintenance');
Route::get('/closed', function () {return view('front.maintenance.regs-closed');})->name('regs-closed');

Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        if (Auth::check()) {
            return redirect('/back/dashboard');
        }
        return redirect('/login');
    });
    
    Route::prefix('back')->name('back.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        Route::resource('menu', MenuController::class)->middleware('role:1,2');

        Route::resource('menu-category', MenuCategoryController::class)->middleware('role:1,2');
    
        Route::resource('ruangan', RuanganController::class)->middleware('role:1,2');

        Route::resource('users', UserController::class);
        Route::get('/profile', [UserController::class, 'show']);

        Route::resource('/config', ConfigController::class)->only(['index'])->middleware('role:1');
        Route::post('/config/update', [ConfigController::class, 'update'])->name('config.update');        

        Route::get('registrasis', [BackRegistrasiController::class, 'index'])->name('registrasis.index');
        Route::get('registrasis/{registrasi}/edit', [BackRegistrasiController::class, 'edit'])->name('registrasis.edit');
        Route::put('registrasis/{registrasi}/reject', [BackRegistrasiController::class, 'reject'])->name('registrasis.reject');
        Route::put('registrasis/{registrasi}/restore', [BackRegistrasiController::class, 'restore'])->name('registrasis.restore');
        Route::delete('registrasis/{registrasi}', [BackRegistrasiController::class, 'destroy'])->name('registrasis.destroy');
        Route::get('/registrasis/pending', [BackRegistrasiController::class, 'getPendingRegistrations'])->name('registrasi.get');
        Route::put('registrasis/{registrasi}', [BackRegistrasiController::class, 'update'])->name('registrasis.update');
        Route::get('registrasis/{registrasi}/card', [BackRegistrasiController::class, 'showCard'])->name('registrasis.card');
        Route::get('registrasis/{registrasi}/kirim-pesan-whatsapp', [BackRegistrasiController::class, 'sendWhatsAppMessage'])->name('registrasis.kirimPesan');
        Route::put('/registrasi/{registrasi}/save-note', [BackRegistrasiController::class, 'saveNote'])->name('registrasi.saveNote');
        Route::put('/registrasi/{registrasi}/mark-as-notified', [BackRegistrasiController::class, 'markAsNotified'])->name('registrasi.markAsNotified');
        Route::get('/registrasisApproved', [BackRegistrasiController::class, 'indexApproved'])->name('registrasis.indexApproved');

        Route::get('/registrasi-data', [BackRegistrasiController::class, 'getRegistrasiData']);
        Route::get('/registrasi-approved-data', [BackRegistrasiController::class, 'getApprovedData']);

        Route::resource('articles', ArticleController::class)->middleware('role:1,2');
        
        Route::get('/contact', [ContactPageController::class, 'index'])->name('contact.index')->middleware('role:1,2');
        Route::put('/contact', [ContactPageController::class, 'update'])->name('contact.update')->middleware('role:1,2');
        
        Route::get('/export', [ExportController::class, 'showExportPage'])->name('export.index')->middleware('role:1'); 
        Route::get('/registrasi-export', [ExportController::class, 'exportCsv'])->name('export.csv')->middleware('role:1');
        Route::get('/advance-export', [ExportController::class, 'advanceExport'])->name('export.advance')->middleware('role:1');

        Route::get('/server-stats', [ServerStatsController::class, 'index'])->name('server.stats');;
        Route::get('/server-stats/data', [ServerStatsController::class, 'stats'])->name('server.stats.data');

        Route::post('/back/reset-db', [DataResetController::class, 'resetDB'])->name('resetdb')->middleware('role:1');
    });

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();

    Route::get('back/storage/{path}', function ($path) {
        return response()->file(storage_path('app/public/' . $path));
    })->where('path', '.*');
    
    });
});

Auth::routes();
