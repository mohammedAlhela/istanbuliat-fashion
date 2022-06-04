<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\AdminController;

Route::get("admins", [AdminController::class, "index"]);
Route::post("admin/store/", [AdminController::class, "store"]);
Route::post("admin/update/{admin}", [AdminController::class, "update"]);
Route::delete("admin/{admin}", [AdminController::class, "delete"]);
Route::get('/admins/excel/export', [AdminController::class, 'exportExcel'])->name('admins-export-excel');
Route::get("admin/updateStatus/{admin}", [AdminController::class, "updateStatus"]);

