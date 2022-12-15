<?php

use App\Http\Controllers\CustomerLoginController;
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

Route::get('/login', [CustomerLoginController::class, 'loginForm'])->name('customer.login.form');
Route::post('/login', [CustomerLoginController::class, 'loginAction'])->name('customer.login.action');
Route::post('/logout', [CustomerLoginController::class, 'logout'])->name('customer.logout');