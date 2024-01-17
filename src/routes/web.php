<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\DonationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/login', [PageController::class, 'login']);
Route::get('/donations', [DonationController::class, 'index'])->name('donations');
Route::get('/donations/my-donations', [DonationController::class, 'myDonations'])->name('my_donations');

Route::post('/login', [AuthController::class,'login'])->name('login');
Route::post('/donate', [DonationController::class,'donate'])->name('donate');

Route::resources([
    '/donation' => DonationController::class,
]);
