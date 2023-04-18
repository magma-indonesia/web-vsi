<?php

use App\Http\Controllers\Auth\ForgotController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Landing\CollabController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Landing\ContactController;
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
Route::get('register', [RegisterController::class, 'index'])
    ->middleware('guest')
    ->name('register.index');
Route::post('register', [RegisterController::class, 'register'])
    ->middleware('guest')
    ->name('register.post');
Route::get('forgot', [ForgotController::class, 'index'])
    ->middleware('guest')
    ->name('forgot.index');
Route::post('forgot', [ForgotController::class, 'forgot'])
    ->middleware('guest')
    ->name('forgot.post');
Route::get('/reset-password/{token}', function ($token) {
        return view("forgot.reset", ["token" => $token]);
    })->name('password.reset');
Route::post('/reset-password', [ForgotController::class, 'resetPassword'])->name('reset.post');
Route::get('logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

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

// Gunung Api
Route::name('gunung-api.')->group(function () {
    $gunungApi = 'home.gunung-api.';

    // Gunung Api > Data Dasar
    Route::view(
        'data-dasar',
        "$gunungApi.data-dasar.index"
    )->name('data-dasar');
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
        // $kerjaSama.informasi.index
        Route::get(
            'informasi',
            [CollabController::class, 'index']
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

    // Layanan Publik > Hubungi Kami
    Route::get(
        'kontak',
        [ContactController::class, 'index']
    )->name('kontak');

    Route::post(
        'kontak',
        [ContactController::class, 'save']
    )->name('kontak.save');
});

Route::prefix('settings')->name('settings.')->group(function () {
    Route::prefix('employee')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('employee.index');
        Route::get('/create', 'create')->name('employee.create');
        Route::post('/', 'store')->name('employee.store');
        Route::get('/{id}/edit', 'edit')->name('employee.edit');
        Route::put('/{id}', 'update')->name('employee.update');
        Route::delete('/{id}', 'destroy')->name('employee.destroy');
        Route::get('/export', 'export')->name('employee.export');
    });

    Route::prefix('upload')->controller(FileController::class)->group(function () {
        Route::get('/', 'index')->name('upload.index');
        Route::get('/create', 'create')->name('upload.create');
        Route::post('/', 'store')->name('upload.store');
        Route::get('/{id}/edit', 'edit')->name('upload.edit');
        Route::put('/{id}', 'update')->name('upload.update');
        Route::delete('/{id}', 'destroy')->name('upload.destroy');
    });
});

Route::get('/files/{id}/{name}', [FileController::class, 'download'])->name('files.download');
