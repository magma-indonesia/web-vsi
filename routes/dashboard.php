<?php

use App\Http\Controllers\Administration\AdministrationController;
use App\Http\Controllers\Administration\FinanceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
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

// Default routing dashboard
Route::get('/', [DashboardController::class, 'index'])
    ->name('index');

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

    // Layanan Publik > Kontak
    Route::get('/kontak', [ContactController::class, 'index'])->name('kontak');

});
