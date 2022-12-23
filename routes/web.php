<?php

use App\Http\Controllers\CustomerBookingController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['as' => 'customer.'], function(){
    Route::get('/login', [CustomerLoginController::class, 'loginForm'])->name('login.form');
    Route::post('/login', [CustomerLoginController::class, 'loginAction'])->name('login.action');
    Route::post('/logout', [CustomerLoginController::class, 'logout'])->name('logout');

    Route::get('/register', [CustomerRegisterController::class, 'form'])->name('register.form');
    Route::post('/register', [CustomerRegisterController::class, 'action'])->name('register.action');

    Route::middleware(['auth:customer'])->group(function(){
        Route::get('booking', [CustomerBookingController::class, 'form'])->name('booking.form');
        Route::post('booking', [CustomerBookingController::class, 'store'])->name('booking.store');
    });
});