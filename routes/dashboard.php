<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.index');
})->name('index');

// Pegawai
Route::prefix('pegawai')->name('pegawai.')->group(function () {

    // Pegawai > Index
    Route::get('/', [UserController::class, 'index'])->name('index');

    // Pegawai > Create
    Route::get('create', [UserController::class, 'create'])->name('create');

    // Pegawai > Show
    Route::get('/{user}', [UserController::class, 'show'])->name('show');

    // Pegawai > Update
    Route::put('/{user}', [UserController::class, 'store'])->name('update');

});

// Layanan Publik
Route::prefix('layanan-publik')->name('layanan-publik.')->group(function () {

    $layananPublik = 'dashboard.layanan-publik';

    // Layanan Publik > Kerja Sama > Informasi Kerja Sama
    Route::prefix('kerja-sama')->name('kerja-sama.')->group(function () use ($layananPublik) {

        $kerjaSama = "$layananPublik.kerja-sama";

        // Layanan Publik > Kerja Sama > Informasi Kerja Sama
        Route::view(
            'informasi',
            "$kerjaSama.informasi.index"
        )->name('informasi');

    });

});
