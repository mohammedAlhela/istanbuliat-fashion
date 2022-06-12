<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customers\ShopController;

Route::get("shop", [ShopController::class, "index"])->name('customers-shop');


