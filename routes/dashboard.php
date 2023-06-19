<?php

use App\Http\Controllers\Administration\AdministrationController;
use App\Http\Controllers\Administration\AnnouncementController;
use App\Http\Controllers\Administration\ContactController;
use App\Http\Controllers\Administration\EqtReportController;
use App\Http\Controllers\Administration\EqtMitigationPublicationController;
use App\Http\Controllers\Administration\EqtListEventController;
use App\Http\Controllers\Administration\EqtStudyEventController;
use App\Http\Controllers\Administration\FinanceController;
use App\Http\Controllers\Administration\GroundResponseController;
use App\Http\Controllers\Administration\PressReleaseController;
use App\Http\Controllers\Administration\VolcanoActivityController;
use App\Http\Controllers\Administration\VolcanoBaseController;
use App\Http\Controllers\Api\ContactController as ApiContactController;
use App\Http\Controllers\Api\FileController as ApiFileController;
use App\Http\Controllers\Api\GroundMovementController as ApiGroundMovementController;
use App\Http\Controllers\Api\ProfileController as ApiProfileController;
use App\Http\Controllers\Api\PublicServiceController as ApiPublicServiceController;
use App\Http\Controllers\Api\RoleController as ApiRoleController;
use App\Http\Controllers\Api\UserController as ApiUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GroundMovement\EventController as GroundMovementEventController;
use App\Http\Controllers\GroundMovementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicServiceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// all route here have prefix dashboard already
// todo, FIND THE FUCK OUT WHY!?

// Tata Usaha
Route::name('admin.')
    ->middleware('auth')
    ->group(function () {

        // employee
        // internal - todo finish internal management user
        Route::get(
            '/admin/employee/index',
            [AdministrationController::class, 'index']
        )->name('employee.index');

        Route::get(
            '/admin/employee/get',
            [AdministrationController::class, 'getEmployee']
        )->name('employee.get');

        // sipeg
        Route::get(
            '/admin/employee/sipeg',
            [AdministrationController::class, 'indexSipeg']
        )->name('employee.sipeg');

        Route::get(
            '/admin/employee/get-sipeg',
            [AdministrationController::class, 'getEmployeeSipeg']
        )->name('employee.get-sipeg');

        // nominative
        Route::get(
            '/admin/finance/input-nominative',
            [FinanceController::class, 'masterNominative']
        )->name('finance.get.master-nominative');

        Route::post(
            '/admin/finance/input-nominative',
            [FinanceController::class, 'saveMasterNominative']
        )->name('finance.post.master-nominative');

        Route::get(
            '/admin/finance/input-nominative/step/nom/{id}',
            [FinanceController::class, 'nominative']
        )->name('finance.get.nominative');

        Route::get(
            '/admin/finance/input-nominative/view/{id}',
            [FinanceController::class, 'viewNominative']
        )->name('finance.view.nominative');

        Route::post(
            '/admin/finance/input-nominative/step/nom',
            [FinanceController::class, 'saveNominative']
        )->name('finance.post.nominative');

        Route::post(
            '/admin/finance/input-nominative/step/bp',
            [FinanceController::class, 'saveBudgetPlan']
        )->name('finance.post.bp');

        Route::post(
            '/admin/finance/input-nominative/step/cpd',
            [FinanceController::class, 'saveCostPlanDetail']
        )->name('finance.post.cpd');

        // tracking sppd
        Route::get(
            '/admin/finance/track-spd',
            [FinanceController::class, 'trackSpd']
        )->name('finance.get.track-spd');

        Route::get(
            '/admin/finance/get-spd',
            [FinanceController::class, 'getDataSpd']
        )->name('finance.post.get-spd');
    });

Route::group(['middleware' => ['auth']], function () {
    // Default routing dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // Pegawai
    Route::prefix('pegawai')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('pegawai.index');
        Route::get('/create', 'create')->name('pegawai.create');
        Route::get('/{id}/edit', 'edit')->name('pegawai.edit');
        Route::get('/export', 'export')->name('pegawai.export');
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

        // Layanan Publik > Kontak
        Route::get('/kontak', [ContactController::class, 'index'])->name('kontak');
        Route::get('/kontak/apis/detail', [ContactController::class, 'detail'])->name('kontak.detail');

        Route::prefix('pengumuman')->name('pengumuman.')->group(function () {
            Route::get('/', [AnnouncementController::class, 'index'])->name('index');
            Route::get('/add', [AnnouncementController::class, 'add'])->name('add');
            Route::get('/edit/{id}', [AnnouncementController::class, 'edit'])->name('edit');
            Route::group(['prefix' => 'apis'], function () {
                Route::get('/', [AnnouncementController::class, 'get'])->name('get');
                Route::post('/', [AnnouncementController::class, 'store'])->name('save');
                Route::put('/', [AnnouncementController::class, 'update'])->name('update');
                Route::delete('/', [AnnouncementController::class, 'delete'])->name('delete');
            });
        });

        Route::controller(PublicServiceController::class)->group(function () {
            Route::get('/{category}', 'index')->name('index');
            Route::get('/{category}/create', 'create')->name('create');
            Route::get('/{category}/{id}/edit', 'edit')->name('edit');
        });
    });

    // Gerakan Tanah
    Route::prefix('gerakan-tanah')->name('gerakan-tanah.')->group(function () {
        // Gerakan Tanah > Daftar Kejadian
        Route::prefix('kejadian')->controller(GroundMovementEventController::class)->group(function () {
            Route::get('/', 'index')->name('kejadian.index');
            Route::get('/create', 'create')->name('kejadian.create');
            Route::post('/', 'store')->name('kejadian.store');
            Route::get('/{id}/edit', 'edit')->name('kejadian.edit');
            Route::put('/{id}', 'update')->name('kejadian.update');
            Route::delete('/{id}', 'destroy')->name('kejadian.destroy');
        });

        Route::controller(GroundMovementController::class)->group(function () {
            Route::get('/{category}', 'index')->name('index');
            Route::get('/{category}/create', 'create')->name('create');
            Route::get('/{category}/{id}/edit', 'edit')->name('edit');
        });
    });

    Route::prefix('tanggapan-kejadian')->name('tanggapan-kejadian.')->group(function () {
        Route::get('/', [GroundResponseController::class, 'index'])->name('index');
        Route::get('/add', [GroundResponseController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [GroundResponseController::class, 'edit'])->name('edit');
        Route::group(['prefix' => 'apis'], function () {
            Route::get('/', [GroundResponseController::class, 'get'])->name('get');
            Route::post('/', [GroundResponseController::class, 'store'])->name('save');
            Route::put('/', [GroundResponseController::class, 'update'])->name('update');
            Route::delete('/', [GroundResponseController::class, 'delete'])->name('delete');
        });
    });

    Route::prefix('press-release')->name('press-release.')->group(function () {
        Route::get('/', [PressReleaseController::class, 'index'])->name('index');
        Route::get('/add', [PressReleaseController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [PressReleaseController::class, 'edit'])->name('edit');
        Route::group(['prefix' => 'apis'], function () {
            Route::get('/', [PressReleaseController::class, 'get'])->name('get');
            Route::get('/files', [PressReleaseController::class, 'files'])->name('files');
            Route::post('/', [PressReleaseController::class, 'store'])->name('save');
            Route::put('/', [PressReleaseController::class, 'update'])->name('update');
            Route::delete('/', [PressReleaseController::class, 'delete'])->name('delete');
        });
    });

    Route::prefix('gunung-api')->name('gunung-api.')->group(function () {
        Route::prefix('data-dasar')->name('data-dasar.')->group(function () {
            Route::get('/', [VolcanoBaseController::class, 'index'])->name('index');
            Route::get('/add', [VolcanoBaseController::class, 'add'])->name('add');
            Route::get('/edit/{id}', [VolcanoBaseController::class, 'edit'])->name('edit');
            Route::group(['prefix' => 'apis'], function () {
                Route::get('/', [VolcanoBaseController::class, 'get'])->name('get');
                Route::post('/', [VolcanoBaseController::class, 'store'])->name('save');
                Route::put('/', [VolcanoBaseController::class, 'update'])->name('update');
                Route::delete('/', [VolcanoBaseController::class, 'delete'])->name('delete');
            });
        });

        Route::prefix('tingkat-aktivitas')->name('tingkat-aktivitas.')->group(function () {
            Route::get('/', [VolcanoActivityController::class, 'index'])->name('index');
            Route::get('/add', [VolcanoActivityController::class, 'add'])->name('add');
            Route::get('/edit/{id}', [VolcanoActivityController::class, 'edit'])->name('edit');
            Route::group(['prefix' => 'apis'], function () {
                Route::get('/', [VolcanoActivityController::class, 'get'])->name('get');
                Route::post('/', [VolcanoActivityController::class, 'store'])->name('save');
                Route::put('/', [VolcanoActivityController::class, 'update'])->name('update');
                Route::delete('/', [VolcanoActivityController::class, 'delete'])->name('delete');
            });
        });
    });

    Route::prefix('gempa-bumi-tsunami')->name('gempa-bumi-tsunami.')->group(function () {
        Route::prefix('kajian-kejadian')->name('kajian-kejadian.')->group(function () {
            Route::get('/', [EqtStudyEventController::class, 'index'])->name('index');
            Route::get('/add', [EqtStudyEventController::class, 'add'])->name('add');
            Route::get('/edit/{id}', [EqtStudyEventController::class, 'edit'])->name('edit');
            Route::group(['prefix' => 'apis'], function () {
                Route::get('/', [EqtStudyEventController::class, 'get'])->name('get');
                Route::post('/', [EqtStudyEventController::class, 'store'])->name('save');
                Route::put('/', [EqtStudyEventController::class, 'update'])->name('update');
                Route::delete('/', [EqtStudyEventController::class, 'delete'])->name('delete');
            });
        });

        Route::prefix('daftar-kejadian')->name('daftar-kejadian.')->group(function () {
            Route::get('/', [EqtListEventController::class, 'index'])->name('index');
            Route::get('/add', [EqtListEventController::class, 'add'])->name('add');
            Route::get('/edit/{id}', [EqtListEventController::class, 'edit'])->name('edit');
            Route::group(['prefix' => 'apis'], function () {
                Route::get('/', [EqtListEventController::class, 'get'])->name('get');
                Route::post('/', [EqtListEventController::class, 'store'])->name('save');
                Route::put('/', [EqtListEventController::class, 'update'])->name('update');
                Route::delete('/', [EqtListEventController::class, 'delete'])->name('delete');
            });
        });

        Route::prefix('publikasi-mitigasi')->name('publikasi-mitigasi.')->group(function () {
            Route::get('/', [EqtMitigationPublicationController::class, 'index'])->name('index');
            Route::get('/add', [EqtMitigationPublicationController::class, 'add'])->name('add');
            Route::get('/edit/{id}', [EqtMitigationPublicationController::class, 'edit'])->name('edit');
            Route::group(['prefix' => 'apis'], function () {
                Route::get('/', [EqtMitigationPublicationController::class, 'get'])->name('get');
                Route::post('/', [EqtMitigationPublicationController::class, 'store'])->name('save');
                Route::put('/', [EqtMitigationPublicationController::class, 'update'])->name('update');
                Route::delete('/', [EqtMitigationPublicationController::class, 'delete'])->name('delete');
            });
        });

        Route::prefix('laporan-singkat')->name('laporan-singkat.')->group(function () {
            Route::get('/', [EqtReportController::class, 'index'])->name('index');
            Route::get('/add', [EqtReportController::class, 'add'])->name('add');
            Route::get('/edit/{id}', [EqtReportController::class, 'edit'])->name('edit');
            Route::group(['prefix' => 'apis'], function () {
                Route::get('/', [EqtReportController::class, 'get'])->name('get');
                Route::post('/', [EqtReportController::class, 'store'])->name('save');
                Route::put('/', [EqtReportController::class, 'update'])->name('update');
                Route::delete('/', [EqtReportController::class, 'delete'])->name('delete');
            });
        });
    });

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/{id}/form', 'edit')->name('index');
        });
    });

    // Upload Center
    Route::prefix('upload-center')->name('upload-center.')->group(function () {
        Route::controller(FileController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
        });
    });

    // Role
    Route::prefix('role')->name('role.')->controller(RoleController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::get('/{id}/policy', 'policy')->name('policy');
    });

    // Api
    Route::group(['prefix' => 'api'], function () {
        // Gerakan Tanah
        Route::group(['prefix' => 'gerakan-tanah'], function () {
            Route::controller(ApiGroundMovementController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('/', 'store');
                Route::put('/', 'update');
                Route::delete('/', 'destroy');
            });
        });

        // Profile
        Route::group(['prefix' => 'profile'], function () {
            Route::controller(ApiProfileController::class)->group(function () {
                Route::post('/', 'store');
                Route::put('/', 'update');
            });
        });

        // Pegawai
        Route::group(['prefix' => 'pegawai'], function () {
            Route::controller(ApiUserController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('/', 'store');
                Route::put('/', 'update');
                Route::delete('/', 'destroy');
            });
        });

        // Upload Center
        Route::group(['prefix' => 'upload-center'], function () {
            Route::controller(ApiFileController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('/', 'store');
                Route::delete('/', 'destroy');
                Route::get('/label', 'indexLabel');
                Route::get('/tags', 'indexTags');
                Route::post('/tags', 'storeTag');
            });
        });

        // Layanan Publik
        Route::group(['prefix' => 'layanan-publik'], function () {
            Route::controller(ApiPublicServiceController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('/', 'store');
                Route::put('/', 'update');
                Route::delete('/', 'destroy');
            });
            Route::controller(ApiContactController::class)->group(function () {
                Route::get('/kontak', 'index');
            });
        });

        // Role
        Route::group(['prefix' => 'role'], function () {
            Route::controller(ApiRoleController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('/', 'store');
                Route::put('/', 'update');
                Route::delete('/', 'destroy');
                Route::put('/policy', 'updatePolicy');
            });
        });

        // Change Password
        Route::group(['prefix' => 'change-password'], function () {
            Route::controller(ApiUserController::class)->group(function () {
                Route::put('/', 'updatePassword');
            });
        });
    });

    // Change Password
    Route::prefix('change-password')->name('change-password.')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/{id}/change-password', 'editPassword')->name('edit');
        });
    });
});
