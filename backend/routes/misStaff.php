<?php

use App\Http\Controllers\MisStaffController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'misStaff'])->group(function () {
    Route::get('/mis', [MisStaffController::class, 'dashboard']);

    Route::post('/addUser', [MisStaffController::class, 'addUser']);//add user
    
});

