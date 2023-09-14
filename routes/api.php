<?php
use App\Http\Controllers\Administration\MountainController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('search-city', [\App\Http\Controllers\Administration\AdministrationController::class, 'searchCity'])
    ->middleware('log.route')
    ->name('api.search-city');

Route::get('search-employee', [\App\Http\Controllers\Administration\AdministrationController::class, 'searchEmployee'])
    ->middleware('log.route')
    ->name('api.search-employee');

Route::get('search-activity/{segment}', [\App\Http\Controllers\Administration\AdministrationController::class, 'searchActivity'])
    ->middleware('log.route')
    ->name('api.search-activity');

Route::get('get-mbp', [\App\Http\Controllers\Administration\AdministrationController::class, 'getMasterBudgetPlan'])
    ->middleware('log.route')
    ->name('api.get-mbp');

Route::get("mountain", [MountainController::class, 'get'])->middleware('log.route');
Route::post("upload", [UploadController::class, 'uploadFile'])->middleware('log.route');
Route::post('upload/base64', [UploadController::class, 'uploadFileBase64'])->middleware('log.route');