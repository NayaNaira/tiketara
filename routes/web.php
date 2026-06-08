<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\AcaraController;


Route::get('/', function () {
    return view('welcome');
});

//Route Login
Route::get('/login', function () {
    return view('auth.login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login']);


//Route Register
Route::get('/register', function () {
    return view('auth.register');
    })->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');  

//Route Logout
Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();

    return redirect('/login');
    })->name('logout');


//Route Email Verifikasi
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

        return redirect('/login')
        ->with('success', 'Email berhasil diverifikasi.');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {

     $request->user()->sendEmailVerificationNotification();

     return back()->with('success', 'Link verifikasi dikirim ulang.');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');



//Route User  
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

// Route Forgot Password

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])
->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])
->name('password.email');

Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])
->name('password.reset');

Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])
->name('password.update');

//route acara
Route::apiResource('/acara', AcaraController::class); 

use App\Models\Acara;

Route::get('/test-acara', function () {
    $acara = App\Models\Acara::all();
    return view('test-acara', compact('acara'));
});

Route::get('/test-acara/{id}', function ($id) {
    $acara = App\Models\Acara::all();
    $edit = App\Models\Acara::findOrFail($id);

    return view('test-acara', compact('acara', 'edit'));
});

Route::post('/test-acara', [AcaraController::class, 'store']);
Route::post('/test-acara/update/{id}', [AcaraController::class, 'update']);
Route::post('/test-acara/delete/{id}', [AcaraController::class, 'destroy']);