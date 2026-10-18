<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
// use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\RegistrationController;
use App\Models\Event;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Frontend pages for the Campus Events Platform
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', function () {
    return view('events.index');
});

Route::get('/dashboard', function () {

    $weeklyEvents = Event::all();

    return view('events.dashboard', compact('weeklyEvents'));
});

// User Login Page
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// User Registration
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Show Events
Route::get('/events', function () {
    return view('events.events');
})->name('events.events');

// Add Events
Route::get('/create', function () {
    return view('events.create');
})->name('events.create');

// List Events
Route::get('/events', function () {
    return view('events.events');
});

// Event Registration
Route::get('/events', function () {
    return view('events.events');
})->name('events');

// Manage Events
Route::get('/manage', function () {
    return view('events.manage');
});

// Edit Events
Route::get('/edit/{id}', function ($id) {
    return view('events.edit', [
        'id' => $id
    ]);
});

// Reset password form
Route::get('/reset_password', function (){
    return view('auth.reset_password');
})->name('password.request');

//Reset Link
// Route::post('/reset_password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
 //  ->name('password.email');


Route::get('/registrations',
    [RegistrationController::class, 'index']
);
