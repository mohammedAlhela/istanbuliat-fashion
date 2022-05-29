<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\ColorController;
use App\Http\Controllers\Admins\SizeController;
use App\Http\Controllers\Admins\BrandController;


Route::get("colors", [ColorController::class, "index"]);
Route::post("color/store", [ColorController::class, "store"]);
Route::post("color/update/{color}", [ColorController::class, "update"]);
Route::delete("color/{color}", [ColorController::class, "delete"]);
Route::post('/colors/import', [ColorController::class, 'import']);
Route::get('/colors/export', [ColorController::class, 'export']);

Route::get("sizes", [SizeController::class, "index"]);
Route::post("size/store", [SizeController::class, "store"]);
Route::post("size/update/{size}", [SizeController::class, "update"]);
Route::delete("size/{size}", [SizeController::class, "delete"]);
Route::post('/sizes/import', [SizeController::class, 'import']);
Route::get('/sizes/export', [SizeController::class, 'export']);
