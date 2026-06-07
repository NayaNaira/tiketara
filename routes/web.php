<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login']);


Route::get('/register', function () {
    return view('auth.register');
    })->name('register');

    Route::post('/register', [AuthController::class, 'register'])->name('register');  

    Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();

    return redirect('/login');
    })->name('logout');


Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:promotor,super_admin']);

Route::get('/super', function () {
    return view('super.dashboard');
})->middleware(['auth', 'role:super_admin']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:pembeli,promotor,super_admin']);

Route::get('/test-middleware', function () {
    dd(class_exists(\App\Http\Middleware\RoleMiddleware::class));
});