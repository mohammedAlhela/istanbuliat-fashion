<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admins\DashboardController;


Route::get("/admins/dashboard", [DashboardController::class, "index"]);

Route::get("/dashboard/getData", [DashboardController::class, "getData"]);

