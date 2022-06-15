<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admins\AdminController;

Route::get("/admins/users", [AdminController::class, "index"]);

Route::get("/admins/getData", [AdminController::class, "getData"]);

Route::post("/admin/store", [AdminController::class, "store"]);

Route::post("/admin/update/{admin}", [AdminController::class, "update"]);

Route::delete("/admin/{admin}", [AdminController::class, "delete"]);

Route::get('/admins/excel/export', [AdminController::class, 'exportExcel']);

Route::get("admin/updateStatus/{admin}", [AdminController::class, "updateStatus"]);

