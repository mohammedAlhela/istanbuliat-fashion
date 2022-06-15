<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\SubscribeController;

use App\Http\Controllers\Auth\Custom\AccountController;

use App\Http\Controllers\Customers\HomePageController;


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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('show-home');

Route::get('redirects', [HomeController::class, 'redirectAfterLogin'])->name('redirect-after-login');

Route::post('/subscriber/add', [SubscribeController::class, 'subscribe'])->name('add-subscriber');

Route::get('/account', [AccountController::class, 'account'])->name('show-account');

Route::get('/orders', [AccountController::class, 'orders'])->name('show-orders');

Route::get('/address', [AccountController::class, 'address'])->name('show-address');

Route::post('/account/update', [AccountController::class, 'accountUpdate'])->name('account-update');

Route::post('/address/update', [AccountController::class, 'addressUpdate'])->name('address-update');



