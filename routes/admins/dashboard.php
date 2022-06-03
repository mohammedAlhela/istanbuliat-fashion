<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\DashboardController;

Route::get("/dashboard/getData", [DashboardController::class, "getData"]);

