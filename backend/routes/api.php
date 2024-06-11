<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 */

Route::middleware('auth:sanctum')->group(function () {
    // logout
    Route::get('/logout', [UserController::class, 'logout']);

    Route::get('/profile', [UserController::class, 'viewProfile']);

    // Route to get a specific user by ID
    Route::get('/user/{name}', [UserController::class, 'viewUser']);

    // Add other routes here as needed
});


Route::post('/login', [UserController::class, 'login']);
