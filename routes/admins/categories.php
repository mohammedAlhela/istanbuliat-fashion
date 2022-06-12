<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\CategoryController;

Route::get("categories", [CategoryController::class, "index"]);
Route::post("category/store", [CategoryController::class, "store"]);
Route::post("category/update/{category}", [CategoryController::class, "update"]);
Route::get("category/updateStatus/{category}", [CategoryController::class, "updateStatus"]);
Route::delete("category/{category}", [CategoryController::class, "delete"]);
Route::get('/categories/excel/export', [CategoryController::class, 'exportExcel']);
