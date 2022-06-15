<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\ProductController;
use App\Http\Controllers\Admins\VariationController;
use App\Http\Controllers\Admins\ProductColorImageController;
 use App\Http\Controllers\Admins\SizeGuideController;

Route::get("/admins/products ", [ProductController::class, "index"]);
Route::get("/products/getData ", [ProductController::class, "getProductsData"]);
Route::get("/products/options/getData", [ProductController::class, "getOptionsData"]);
Route::post("/product/store", [ProductController::class, "store"]);
Route::post("/product/update/{product}", [ProductController::class, "update"]);
Route::delete("/product/{product}", [ProductController::class, "delete"]);
Route::get('/products/excel/export', [ProductController::class, 'exportExcel']);
Route::get("/product/updateStatus/{product}", [ProductController::class, "updateStatus"]);


Route::post("/variation/store", [VariationController::class, "add"]);
Route::post("/variation/update/{variation}", [VariationController::class, "update"]);
Route::delete("/variation/{variation}", [VariationController::class, "delete"]);


Route::post("/productColorImage/store", [ProductColorImageController::class, "add"]);
Route::post("/productColorImage/update/{productColorImage}", [ProductColorImageController::class, "update"]);
Route::delete("/productColorImage/{productColorImage}", [ProductColorImageController::class, "delete"]);


Route::post("/sizeGuide/store", [SizeGuideController::class, "add"]);
Route::post("/sizeGuide/update/{sizeGuide}", [SizeGuideController::class, "update"]);
Route::delete("/sizeGuide/{sizeGuide}", [SizeGuideController::class, "delete"]);

