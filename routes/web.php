<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home
Route::get('/', function () {
    return view('home.index');
})->name('home');

// Login
Route::get('login', [LoginController::class, 'index'])
    ->middleware('guest')
    ->name('login.index');
Route::post('login', [LoginController::class, 'login'])
    ->middleware('guest')
    ->name('login.post');

// Profil
Route::name('profile.')->group(function () {

    $profil = 'home.profile.';

    // Profile > Tentang PVMBG
    Route::view(
        'tentang-pvmbg',
        "$profil.tentang-pvmbg.index"
    )->name('tentang-pvmbg');

    // Profile > Struktur Organisasi
    Route::view(
        'struktur-organisasi',
        "$profil.struktur-organisasi.index"
    )->name('struktur-organisasi');

    // Profile > sejarah
    Route::view(
        'sejarah',
        "$profil.sejarah.index"
    )->name('sejarah');
});

// Layanan Publik
Route::prefix('layanan-publik')->name('layanan-publik.')->group(function () {

    $layananPublik = 'home.layanan-publik';

    // Layanan Publik > Reformasi Birokrasi
    Route::view(
        'reformasi-birokrasi',
        "$layananPublik.reformasi-birokrasi.index"
    )->name('reformasi-birokrasi');

    // Layanan Publik > Diseminasi Informasi > Gunung Api
    Route::view(
        'diseminasi-informasi/gunung-api',
        "$layananPublik.diseminasi-informasi.gunung-api.index"
    )->name('diseminasi-informasi.gunung-api');

    // Layanan Publik > Kerja Sama
    Route::prefix('kerja-sama')->name('kerja-sama.')->group(function () use ($layananPublik) {

        $kerjaSama = "$layananPublik.kerja-sama";

        // Layanan Publik > Kerja Sama > Informasi Kerja Sama
        Route::view(
            'informasi-kerja-sama',
            "$kerjaSama.informasi-kerja-sama.index"
        )->name('informasi-kerja-sama');

        // Layanan Publik > Kerja Sama > Dalam Negeri > Bilateral
        Route::view(
            'dalam-negeri/bilateral',
            "$kerjaSama.dalam-negeri.bilateral"
        )->name('dalam-negeri.bilateral');

        // Layanan Publik > Kerja Sama > Dalam Negeri > Multilateral
        Route::view(
            'dalam-negeri/multilateral',
            "$kerjaSama.dalam-negeri.multilateral"
        )->name('dalam-negeri.multilateral');

        // Layanan Publik > Kerja Sama > Luar Negeri
        Route::view(
            'luar-negeri',
            "$kerjaSama.luar-negeri.index"
        )->name('luar-negeri');
    });
});
