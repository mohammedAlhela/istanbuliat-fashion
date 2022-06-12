<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customers\WishlistController;

Route::get('wishlists', [WishlistController::class, 'index']);
Route::get('wishlists/getData', [WishlistController::class, 'getData']);
Route::delete('wishlist/{product}', [WishlistController::class, 'delete']);
Route::post('wishlist/add', [WishlistController::class, 'add']);