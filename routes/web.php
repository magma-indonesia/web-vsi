<?php

use App\Http\Controllers\Administration\EqtListEventController as AdministrationEqtListEventController;
use App\Http\Controllers\Administration\EqtMitigationPublicationController as AdministrationEqtMitigationPublicationController;
use App\Http\Controllers\Administration\EqtReportController as AdministrationEqtReportController;
use App\Http\Controllers\Administration\EqtStudyEventController as AdministrationEqtStudyEventController;
use App\Http\Controllers\Administration\GroundResponseController as AdministrationGroundResponseController;
use App\Http\Controllers\Administration\NewsController;
use App\Http\Controllers\Administration\PressReleaseController as AdministrationPressReleaseController;
use App\Http\Controllers\Administration\VolcanoActivityController as AdministrationVolcanoActivityController;
use App\Http\Controllers\Administration\VolcanoBaseController as AdministrationVolcanoBaseController;
use App\Http\Controllers\Api\GroundMovementController;
use App\Http\Controllers\Api\PublicServiceController;
use App\Http\Controllers\Landing\NewsController as LandingNewsController;
use App\Http\Controllers\Auth\ForgotController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Landing\CollabController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Landing\ContactController;
use App\Http\Controllers\Landing\EqtListEventController;
use App\Http\Controllers\Landing\EqtMitigationPublicationController;
use App\Http\Controllers\Landing\EqtReportController;
use App\Http\Controllers\Landing\EqtStudyEventController;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Landing\GroundMovementController as LandingGroundMovementController;
use App\Http\Controllers\Landing\GroundResponseController;
use App\Http\Controllers\Landing\PressReleaseController;
use App\Http\Controllers\Landing\ProfileController as LandingProfileController;
use App\Http\Controllers\Landing\PublicServiceController as LandingPublicServiceController;
use App\Http\Controllers\Landing\SearchController;
use App\Http\Controllers\Landing\VolcanoActivityController;
use App\Http\Controllers\Landing\VolcanoBaseController;
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
Route::prefix('profile')->name('profile.')->group(function () {
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
    Route::prefix('tingkat-aktivitas')->name('tingkat-aktivitas.')->group(function () {
        Route::get('/', [VolcanoActivityController::class, 'index'])->name("index");
        Route::get('/{route}', [VolcanoActivityController::class, 'detail'])->name("detail");

        Route::group(['prefix' => 'apis'], function () {
            Route::get('/get', [AdministrationVolcanoActivityController::class, 'get'])->name('get');
        });
    });
    
    Route::prefix('data-dasar')->name('data-dasar.')->group(function () {
        Route::get('/', [VolcanoBaseController::class, 'index'])->name("index");
        Route::get('/{route}', [VolcanoBaseController::class, 'detail'])->name("detail");

        Route::group(['prefix' => 'apis'], function () {
            Route::get('/get', [AdministrationVolcanoBaseController::class, 'get'])->name('get');
        });
    });
});

Route::prefix('press-release')->name('press-release.')->group(function () {
    Route::get('', [PressReleaseController::class, 'index'])->name("index");
    Route::get('/{route}', [PressReleaseController::class, 'detail'])->name("detail");

    Route::group(['prefix' => 'apis'], function () {
        Route::get('/get', [AdministrationPressReleaseController::class, 'get'])->name('get');
    });
});

Route::prefix('hasil-pencarian')->name('hasil-pencarian.')->group(function () {
    Route::get('', [SearchController::class, 'index'])->name("index");
    // Route::get('/{route}', [PressReleaseController::class, 'detail'])->name("detail");

    Route::group(['prefix' => 'apis'], function () {
        Route::get('/get', [SearchController::class, 'search'])->name('get');
    });
});

Route::name('gerakan-tanah.')->group(function () {
    Route::prefix('tanggapan-kejadian')->name('tanggapan-kejadian.')->group(function () {
        Route::get('/', [GroundResponseController::class, 'index'])->name("index");
        Route::get('/{route}', [GroundResponseController::class, 'detail'])->name("detail");

        Route::group(['prefix' => 'apis'], function () {
            Route::get('/get', [AdministrationGroundResponseController::class, 'get'])->name('get');
        });
    });
});

Route::name('gempa-bumi-tsunami.')->group(function () {
    Route::prefix('kajian-kejadian')->name('kajian-kejadian.')->group(function () {
        Route::get('/', [EqtStudyEventController::class, 'index'])->name("index");
        Route::get('/{route}', [EqtStudyEventController::class, 'detail'])->name("detail");

        Route::group(['prefix' => 'apis'], function () {
            Route::get('/get', [AdministrationEqtStudyEventController::class, 'get'])->name('get');
        });
    });

    Route::prefix('daftar-kejadian')->name('daftar-kejadian.')->group(function () {
        Route::get('/', [EqtListEventController::class, 'index'])->name("index");
        Route::get('/{route}', [EqtListEventController::class, 'detail'])->name("detail");

        Route::group(['prefix' => 'apis'], function () {
            Route::get('/get', [AdministrationEqtListEventController::class, 'get'])->name('get');
        });
    });

    Route::prefix('publikasi-mitigasi')->name('publikasi-mitigasi.')->group(function () {
        Route::get('/', [EqtMitigationPublicationController::class, 'index'])->name("index");
        Route::get('/{route}', [EqtMitigationPublicationController::class, 'detail'])->name("detail");

        Route::group(['prefix' => 'apis'], function () {
            Route::get('/get', [AdministrationEqtMitigationPublicationController::class, 'get'])->name('get');
        });
    });

    Route::prefix('laporan-singkat')->name('laporan-singkat.')->group(function () {
        Route::get('/', [EqtReportController::class, 'index'])->name("index");
        Route::get('/{route}', [EqtReportController::class, 'detail'])->name("detail");

        Route::group(['prefix' => 'apis'], function () {
            Route::get('/get', [AdministrationEqtReportController::class, 'get'])->name('get');
        });
    });
});

// Gerakan Tanah
Route::name('gerakan-tanah.')->group(function () {
    $gerakanTanah = 'home.gerakan-tanah.';

    Route::get('gerakan-tanah', [GroundMovementController::class, 'index']);

    // Gerakan Tanah > Daftar Kejadian
    Route::view(
        'gerakan-tanah/daftar-kejadian',
        "$gerakanTanah.daftar-kejadian.index"
    )->name('daftar-kejadian');
    
    Route::get('/gerakan-tanah/daftar-kejadian/{route}', [LandingGroundMovementController::class, 'showEvent'])->name("daftar-kejadian.detail");

    // Gerakan Tanah > Peringatan Dini
    Route::view(
        'gerakan-tanah/peringatan-dini',
        "$gerakanTanah.peringatan-dini.index"
    )->name('peringatan-dini');
    
    Route::get('gerakan-tanah/peringatan-dini/{route}', [LandingGroundMovementController::class, 'showEarlyWarning'])->name("peringatan-dini.detail");

    // Gerakan Tanah > Rekapitulasi Kejadian
    Route::view(
        'gerakan-tanah/rekapitulasi-kejadian',
        "$gerakanTanah.rekapitulasi-kejadian.index"
    )->name('rekapitulasi-kejadian');
    
    Route::get('gerakan-tanah/rekapitulasi-kejadian/{route}', [LandingGroundMovementController::class, 'showEventRecap'])->name("rekapitulasi-kejadian.detail");
});

// Layanan Publik
Route::prefix('layanan-publik')->name('layanan-publik.')->group(function () {
    $layananPublik = 'home.layanan-publik';

    Route::get('/', [PublicServiceController::class, 'index']);

    // Layanan Publik > Reformasi Birokrasi
    Route::view(
        'reformasi-birokrasi',
        "$layananPublik.reformasi-birokrasi.index"
    )->name('reformasi-birokrasi');
    
    Route::get('/reformasi-birokrasi/{route}', [LandingPublicServiceController::class, 'showBureaucraticReform'])->name("reformasi-birokrasi.detail");

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