<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\ProductController;
use App\Http\Controllers\Admins\VariationController;
use App\Http\Controllers\Admins\VariationImageController;
use App\Http\Controllers\Admins\SizeGuideController;

Route::get("products", [ProductController::class, "index"]);
Route::get("products/options", [ProductController::class, "getOptions"]);
Route::post("product/store", [ProductController::class, "store"]);
Route::post("product/update/{product}", [ProductController::class, "update"]);
Route::delete("product/{product}", [ProductController::class, "delete"]);
Route::get('/products/excel/export', [ProductController::class, 'exportExcel'])->name('products-export-excel');
Route::get("product/updateStatus/{product}", [ProductController::class, "updateStatus"]);


Route::post("variation/store", [VariationController::class, "add"]);
Route::post("variation/update/{variation}", [VariationController::class, "update"]);
Route::delete("variation/{variation}", [VariationController::class, "delete"]);
Route::delete("variation/image/{variation}", [VariationController::class, "deleteImage"]);


Route::post("variationImage/store", [VariationImageController::class, "add"]);
Route::post("variationImage/update/{image}", [VariationImageController::class, "update"]);
Route::delete("variationImage/{image}", [VariationImageController::class, "delete"]);





Route::post("sizeGuide/store", [SizeGuideController::class, "add"]);
Route::post("sizeGuide/update/{sizeGuide}", [SizeGuideController::class, "update"]);
Route::delete("sizeGuide/{sizeGuide}", [SizeGuideController::class, "delete"]);

