<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



// Laporan
Route::get('/laporan', function () {
    return view('laporan');
})->name('laporan');

// Surat Masuk
Route::get('/suratmasuk', [SuratMasukController::class, 'index'])->name('suratmasuk.index');
Route::post('/suratmasuk/store', [SuratMasukController::class, 'store'])->name('suratmasuk.store');
Route::get('/suratmasuk/{id}/edit', [SuratMasukController::class, 'edit'])->name('suratmasuk.edit');
Route::put('/suratmasuk/{id}', [SuratMasukController::class, 'update'])->name('suratmasuk.update');
Route::delete('/suratmasuk/{id}', [SuratMasukController::class, 'destroy'])->name('suratmasuk.destroy');

// Surat Keluar
Route::get('/suratkeluar', [SuratKeluarController::class, 'index'])->name('suratkeluar.index');
Route::post('/suratkeluar/store', [SuratKeluarController::class, 'store'])->name('suratkeluar.store');
Route::get('/suratkeluar/{id}/edit', [SuratKeluarController::class, 'edit'])->name('suratkeluar.edit');
Route::put('/suratkeluar/{id}', [SuratKeluarController::class, 'update'])->name('suratkeluar.update');
Route::delete('/suratkeluar/{id}', [SuratKeluarController::class, 'destroy'])->name('suratkeluar.destroy');
