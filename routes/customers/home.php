<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customers\HomePageController;

Route::get('/', [HomePageController::class, 'index'])->name('homepage');
Route::get('/share', [HomePageController::class, 'shareProduct'])->name('share-product');



