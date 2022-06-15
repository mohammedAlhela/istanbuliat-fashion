<?php
use App\Http\Controllers\Admins\SliderController;
use Illuminate\Support\Facades\Route;

Route::get("/admins/sliders", [SliderController::class, "index"]);

Route::get("/sliders/getData", [SliderController::class, "getData"]);

Route::post("/slider/store/", [SliderController::class, "store"]);
Route::post("/slider/update/{slider}", [SliderController::class, "update"]);
Route::get("/slider/updateStatus/{slider}", [SliderController::class, "updateStatus"]);
Route::delete("/slider/{slider}", [SliderController::class, "delete"]);
