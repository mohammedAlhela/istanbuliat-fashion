<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\SliderController;

Route::get("sliders", [SliderController::class, "index"]);
Route::post("slider/store/", [SliderController::class, "store"]);
Route::post("slider/update/{slider}", [SliderController::class, "update"]);
Route::get("slider/updateStatus/{slider}", [SliderController::class, "updateStatus"]);
Route::delete("slider/{slider}", [SliderController::class, "delete"]);




