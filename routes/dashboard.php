<?php

use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// all route here have prefix dashboard already
// todo, FIND THE FUCK OUT WHY!?

// Default routing dashboard
Route::get('/', [DashboardController::class, 'index'])
    ->name('index');

// Tata Usaha
Route::name('admin.')
    ->middleware('auth')
    ->group(function () {

        Route::get(
            '/admin/finance/input-nominative',
            [AdministrationController::class, 'masterNominative']
        )->name('finance.get.master-nominative');

        Route::post(
            '/admin/finance/input-nominative',
            [AdministrationController::class, 'saveMasterNominative']
        )->name('finance.post.master-nominative');

        Route::get(
            '/admin/finance/input-nominative/step/nom/{id}',
            [AdministrationController::class, 'nominative']
        )->name('finance.get.nominative');

        Route::post(
            '/admin/finance/input-nominative/step/nom',
            [AdministrationController::class, 'saveNominative']
        )->name('finance.post.nominative');

    });
