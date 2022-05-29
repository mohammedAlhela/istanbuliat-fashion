<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\CategoryController;

Route::get("categories", [CategoryController::class, "index"]);
Route::post("category/store", [CategoryController::class, "store"]);
Route::post("category/update/{category}", [CategoryController::class, "update"]);
Route::get("category/updateType/{slider}", [CategoryController::class, "updateType"]);
Route::delete("category/{slider}", [CategoryController::class, "delete"]);

