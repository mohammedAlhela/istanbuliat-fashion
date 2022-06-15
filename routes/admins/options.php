<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\ColorController;
use App\Http\Controllers\Admins\SizeController;


Route::get("/admins/options", [ColorController::class, "index"]);
Route::get("/colors/getData", [ColorController::class, "getData"]);
Route::post("/color/store", [ColorController::class, "store"]);
Route::post("/color/update/{color}", [ColorController::class, "update"]);
Route::delete("/color/{color}", [ColorController::class, "delete"]);
Route::post('/colors/import', [ColorController::class, 'import']);
Route::get('/colors/export', [ColorController::class, 'export']);

Route::get('/tags/getData', [ColorController::class, 'getTagsData']);
Route::post('/tag/update/{tag}', [ColorController::class, 'updateTagName']);

Route::get("/sizes/getData", [SizeController::class, "getData"]);
Route::post("/size/update/{size}", [SizeController::class, "update"]);
Route::post("/size/store", [SizeController::class, "store"]);
Route::delete("/size/{size}", [SizeController::class, "delete"]);
Route::post('/sizes/import', [SizeController::class, 'import']);
Route::get('/sizes/export', [SizeController::class, 'export']);


