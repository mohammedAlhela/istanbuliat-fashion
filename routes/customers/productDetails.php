<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customers\ProductDetailsController;

Route::get('product/{slug}', [ProductDetailsController::class, 'index'])->name('product-details');

