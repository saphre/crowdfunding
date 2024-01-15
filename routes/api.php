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
Route::post('/auth/login', [App\Http\Controllers\AuthController::class, 'login'])->name('api_login');
// PROTECTED ROUTES - Auth
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
// PROTECTED ROUTES - HTTP VERBS
Route::group(['middleware' => 'auth:sanctum'], function () {
    //  Donate
    Route::post('/donation/donate', [App\Http\Controllers\DonationController::class,'donate']);
    Route::get('/donations/my-donations/{id}', [App\Http\Controllers\DonationController::class,'myDonations']);
    
});

// PROTECTED ROUTES - Resources
Route::group(['middleware' => 'auth:sanctum'], function () {
    /**
     *      DONATIONS
     */
    Route::apiResource('donations', 'App\Http\Controllers\DonationController');
    /**
     *      CATEGORIES
     */
    Route::apiResource('categories', 'App\Http\Controllers\CategoryController');
    /**
     *      CURRENCIES
     */
    Route::apiResource('currencies', 'App\Http\Controllers\CurrencyController');

    
});
