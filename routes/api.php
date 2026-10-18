<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\RegistrationController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {

    // Authentication
    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/forgot_password', [AuthController::class, 'forgotPassword']);

    // Events
    Route::get('/events', [EventController::class, 'index']);

    Route::get('/events/{id}', [EventController::class, 'show']);

    // Categories
    Route::get('/categories', [CategoryController::class, 'index']);

});


/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1')
    ->middleware('auth:sanctum')
    ->group(function () {

        // Logout
        Route::post('/logout', [AuthController::class, 'logout']);

        // Event Management
        Route::post('/events', [EventController::class, 'store']);

        Route::put('/events/{id}', [EventController::class, 'update']);

        Route::delete('/events/{id}', [EventController::class, 'destroy']);

        // Category Management
        Route::post('/categories', [CategoryController::class, 'store']);

        // Event Registration
        Route::post('/register-event', [RegistrationController::class, 'store']);

        // View My Registrations
        Route::get('/my-registrations', [RegistrationController::class, 'index']);

    });