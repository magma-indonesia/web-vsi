<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return response()->json([
        'message' => 'It works',
    ]);
})->name('index');

Route::get('sipeg', [TestController::class, 'sipeg'])
    ->name('sipeg');

Route::get('sipeg-service', [TestController::class, 'sipegProvider'])
    ->name('sipegProvider');
