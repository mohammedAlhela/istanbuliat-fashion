<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\CategoryController;
use App\Http\Controllers\Admins\SubCategoryController;
Route::get("/admins/categories", [CategoryController::class, "index"]);
Route::get("/categories/getData", [CategoryController::class, "getData"]);
Route::post("/category/store", [CategoryController::class, "store"]);
Route::post("/category/update/{category}", [CategoryController::class, "update"]);
Route::get("/category/updateStatus/{category}", [CategoryController::class, "updateStatus"]);
Route::delete("/category/{category}", [CategoryController::class, "delete"]);
Route::get('/categories/excel/export', [CategoryController::class, 'exportExcel']);

Route::post("/subCategory/store", [SubCategoryController::class, "store"]);
Route::post("/subCategory/update/{subCategory}", [SubCategoryController::class, "update"]);
Route::get("/subCategory/updateStatus/{subCategory}", [SubCategoryController::class, "updateStatus"]);
Route::delete("/subCategory/{subCategory}", [SubCategoryController::class, "delete"]);