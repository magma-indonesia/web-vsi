<?php

use App\Http\Controllers\Administration\NewsController;
use App\Http\Controllers\Api\GroundMovementController;
use App\Http\Controllers\Landing\NewsController as LandingNewsController;
use App\Http\Controllers\Auth\ForgotController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Landing\CollabController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Landing\ContactController;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Landing\GroundMovementController as LandingGroundMovementController;
use App\Http\Controllers\Landing\ProfileController as LandingProfileController;
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
Route::get('/', [LandingController::class, 'index'])->name('home');

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
    // Route::view(
    //     'tentang-pvmbg',
    //     "$profil.tentang-pvmbg.index"
    // )->name('tentang-pvmbg');
    Route::get('/tentang-pvmbg', [LandingProfileController::class, 'showAbout'])->name("tentang-pvmbg");

    // Profile > Struktur Organisasi
    // Route::view(
    //     'struktur-organisasi',
    //     "$profil.struktur-organisasi.index"
    // )->name('struktur-organisasi');
    Route::get('/struktur-organisasi', [LandingProfileController::class, 'showStructure'])->name("struktur-organisasi");

    // Profile > sejarah
    // Route::view(
    //     'sejarah',
    //     "$profil.sejarah.index"
    // )->name('sejarah');
    Route::get('/sejarah', [LandingProfileController::class, 'showHistory'])->name("sejarah");
});

// Gunung Api
Route::name('gunung-api.')->group(function () {
    $gunungApi = 'home.gunung-api.';

    // Gunung Api > Data Dasar    
    Route::get('/data-dasar', [LandingNewsController::class, 'indexDataDasar'])->name("data-dasar");
    Route::get('/data-dasar/{route}', [LandingNewsController::class, 'detailDataDasar'])->name("data-dasar.detail");

    // Gunung Api > Tingkat Aktivitas
    Route::get('/tingkat-aktivitas', [LandingNewsController::class, 'indexTingkatAktivitas'])->name("tingkat-aktivitas");
    Route::get('/tingkat-aktivitas/{route}', [LandingNewsController::class, 'detailTingkatAktivitas'])->name("tingkat-aktivitas.detail");

    // Gunung Api > Press Release
    Route::get('/press-release', [LandingNewsController::class, 'indexPressRelease'])->name("press-release");
    Route::get('/press-release/{route}', [LandingNewsController::class, 'detailPressRelease'])->name("press-release.detail");

    Route::get('news', [NewsController::class, 'get']);
});

Route::name('gerakan-tanah.')->group(function () {
    $gunungApi = 'home.gerakan-tanah.';

    // Gerakan Tanah > Tanggapan Kejadian
    Route::get('/tanggapan-kejadian', [LandingNewsController::class, 'indexTanggapanKejadian'])->name("tanggapan-kejadian");
    Route::get('/tanggapan-kejadian/{route}', [LandingNewsController::class, 'detailTanggapanKejadian'])->name("tanggapan-kejadian.detail");

    Route::get('news', [NewsController::class, 'get']);
});

Route::name('gempa-bumi-tsunami.')->group(function () {
    $gunungApi = 'home.gempa-bumi-tsunami.';

    Route::get('/kajian-kejadian', [LandingNewsController::class, 'indexKajianKejadian'])->name("kajian-kejadian");
    Route::get('/kajian-kejadian/{route}', [LandingNewsController::class, 'detailKajianKejadian'])->name("kajian-kejadian.detail");

    Route::get('/daftar-kejadian', [LandingNewsController::class, 'indexDaftarKejadian'])->name("daftar-kejadian");
    Route::get('/daftar-kejadian/{route}', [LandingNewsController::class, 'detailDaftarKejadian'])->name("daftar-kejadian.detail");

    Route::get('/publikasi-mitigasi', [LandingNewsController::class, 'indexPublikasiMitigasi'])->name("publikasi-mitigasi");
    Route::get('/publikasi-mitigasi/{route}', [LandingNewsController::class, 'detailPublikasiMitigasi'])->name("publikasi-mitigasi.detail");

    Route::get('/laporan-singkat', [LandingNewsController::class, 'indexLaporanSingkat'])->name("laporan-singkat");
    Route::get('/laporan-singkat/{route}', [LandingNewsController::class, 'detailLaporanSingkat'])->name("laporan-singkat.detail");

    Route::get('news', [NewsController::class, 'get']);
});

// Gerakan Tanah
Route::name('gerakan-tanah.')->group(function () {
    $gerakanTanah = 'home.gerakan-tanah.';

    Route::get('gerakan-tanah', [GroundMovementController::class, 'index']);

    // Gerakan Tanah > Daftar Kejadian
    Route::view(
        'daftar-kejadian',
        "$gerakanTanah.daftar-kejadian.index"
    )->name('daftar-kejadian');
    
    Route::get('/daftar-kejadian/{route}', [LandingGroundMovementController::class, 'showEvent'])->name("daftar-kejadian.detail");

    // Gerakan Tanah > Peringatan Dini
    Route::view(
        'peringatan-dini',
        "$gerakanTanah.peringatan-dini.index"
    )->name('peringatan-dini');
    
    Route::get('/peringatan-dini/{route}', [LandingGroundMovementController::class, 'showEvent'])->name("peringatan-dini.detail");

    // Gerakan Tanah > Rekapitulasi Kejadian
    Route::view(
        'rekapitulasi-kejadian',
        "$gerakanTanah.rekapitulasi-kejadian.index"
    )->name('rekapitulasi-kejadian');
    
    Route::get('/rekapitulasi-kejadian/{route}', [LandingGroundMovementController::class, 'showEvent'])->name("rekapitulasi-kejadian.detail");
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
        'contact',
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
Route::post('/image/upload', [FileController::class, 'storeImage'])->name('image.upload');

Route::group(['middleware' => ['auth'], 'prefix' => 'apis/v1'], function () {
    Route::get('news', [NewsController::class, 'get']);
    Route::post('news', [NewsController::class, 'store']);
    Route::post('news/retrieve', [NewsController::class, 'retrieve']);
    Route::put('news', [NewsController::class, 'update']);
    Route::delete('news', [NewsController::class, 'delete']);
});
