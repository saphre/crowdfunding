<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Route::get('/user', function (Request $request) { return $request->user(); });

//LOGIN
Route::post('/auth/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
// SIGNUP
Route::post('/auth/register/patient', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
// PROTECTED ROUTES - Auth
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
// PROTECTED ROUTES - HTTP VERBS
Route::group(['middleware' => 'auth:sanctum'], function () {
    // SIGNUP
    Route::post('/auth/register/patient', [App\Http\Controllers\AuthController::class, 'register'])->middleware('valid.token')->name('register');
});

// PROTECTED ROUTES - Resources
Route::group(['middleware' => 'auth:sanctum'], function () {
    /**
     *      COMPANIES
     */

    Route::apiResource('donations', 'App\Http\Controllers\DonationController');

    /**
     *  Health Care Unit Types
     */

    Route::apiResource('hcu_types', 'App\Http\Controllers\HealthCareUnitTypeController');

    /**
     *  Health Care Units
     */

    Route::apiResource('hcus', 'App\Http\Controllers\HealthCareUnitController');
});
