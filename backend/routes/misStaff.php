<?php

use App\Http\Controllers\MisStaffController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'misStaff'])->group(function () {
    Route::get('/mis', [MisStaffController::class, 'dashboard']);
    // Add other admin routes here
});

