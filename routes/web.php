<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/check-roles', function () {
    return response()->json([
        'count' => DB::table('roles')->count(),
        'roles' => DB::table('roles')->get()
    ]);
});

Route::get('/', function () {
    return view('events.index');
});

Route::get('/dashboard', function () {
    return response()->json([
        'count' => DB::table('roles')->count(),
        'roles' => DB::table('roles')->get()
    ]);
});

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::get('/events', function () {
    return view('events.events');
})->name('events');

Route::get('/create', function () {
    return view('events.create');
})->name('events.create');

Route::get('/manage', function () {
    return view('events.manage');
});

Route::get('/edit/{id}', function ($id) {
    return view('events.edit', compact('id'));
});

Route::get('/reset_password', function () {
    return view('auth.reset_password');
})->name('password.request');

Route::get('/registrations', [RegistrationController::class, 'index']);
