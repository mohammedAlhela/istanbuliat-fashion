<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/account', [HomeController::class, 'account'])->name('account');
Route::get('/orders', [HomeController::class, 'orders'])->name('orders');
Route::get('/address', [HomeController::class, 'address'])->name('address');
Route::post('/account/update', [HomeController::class, 'accountUpdate'])->name('account-update');
Route::post('/address/update', [HomeController::class, 'addressUpdate'])->name('address-update');
Route::get('redirects', [HomeController::class, 'redirectAfterLogin'])->name('redirect-after-login');
Route::post('/subscriber/add', [HomeController::class, 'addSubscriber'])->name('subscriber.add');


// admins routes +++++++++++++++++++++++++++++++++++++++++++++++++
Route::group([
    'prefix' => 'admins', 'middleware' => 'admin',
], function () {

    Route::get('dashboard', function () {
        return view('admins.dashboard');
    })->name('admins-dashboard');

    Route::get('users', function () {
        return view('admins.admins');
    })->name('admins-users')->middleware('manager');

    Route::get('sliders', function () {
        return view('admins.sliders');
    })->name('admins-sliders');

    Route::get('categories', function () {
        return view('admins.categories');
    })->name('admins-categories');

    Route::get('options', function () {
        return view('admins.options');
    })->name('admins-options');

    Route::get('products', function () {
        return view('admins.products');
    })->name('admins-products');

});
// admins routes +++++++++++++++++++++++++++++++++++++++++++++++++


