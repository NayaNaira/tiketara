<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\buyer\OrderController; 

// Import Controller Khusus Super Admin dari subfolder super_admin
use App\Http\Controllers\super_admin\DashboardController;
use App\Http\Controllers\super_admin\TransactionController;
use App\Http\Controllers\super_admin\EventController as SuperEventController;

use App\Http\Controllers\promoter\EventController as PromoterEventController;
use App\Http\Controllers\buyer\EventController as BuyerEventController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('welcome'));


/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/
// Mengarahkan ke Google dengan aman (Rute Ganda yang bentrok sudah dihapus)
Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->stateless()->redirect();
})->name('auth.google.redirect');

Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login');
})->name('logout');


/*
|--------------------------------------------------------------------------
| EMAIL VERIFICATION ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/email/verify', fn () => view('auth.email-verification'))
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/login')->with('success', 'Email berhasil diverifikasi.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('success', 'Link verifikasi dikirim ulang.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


/*
|--------------------------------------------------------------------------
| PROTECTED DASHBOARD ROUTES (SHARED ACCESSIBILITY)
|--------------------------------------------------------------------------
*/
Route::get('/promoter', fn () => view('.dashboard'))
    ->middleware(['auth', 'role:promoter,super_admin']);

Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'role:buyer,promoter,super_admin']);


/*
|--------------------------------------------------------------------------
| ROLE-BASED ROUTES (AUTHENTICATED USERS)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // ==========================================
    // SUPER ADMIN GROUP (Fixed Role: super_admin)
    // ==========================================
    Route::group(['prefix' => 'super', 'as' => 'super.', 'middleware' => ['role:super_admin']], function() {
        
        // Analytics & Reports
        Route::get('/', [DashboardController::class, 'summary'])->name('dashboard');
        Route::get('/summary', [DashboardController::class, 'summary'])->name('summary');
        Route::get('/reports', [DashboardController::class, 'reports'])->name('reports.index');
        Route::get('/export', [DashboardController::class, 'export'])->name('export');

        // Transactions Management
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/transactions/event/{id}', [TransactionController::class, 'eventList'])->name('transactions.list');
        Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');

        // Event Management & Approval Action
        Route::get('/event', [SuperEventController::class, 'index'])->name('event.manage');
        Route::get('/events/{id}', [SuperEventController::class, 'show'])->name('events.show'); 
        Route::patch('/event/{id}/approve', [SuperEventController::class, 'approve'])->name('event.approve');
        Route::patch('/event/{id}/reject', [SuperEventController::class, 'reject'])->name('event.reject');
        Route::delete('/event/{id}', [SuperEventController::class, 'destroy'])->name('event.destroy');
    });

    // ==========================================
    // PROMOTER GROUP
    // ==========================================
    Route::group(['prefix' => 'promoter', 'as' => 'promoter.', 'middleware' => ['role:promoter']], function() {
        Route::get('/event', [PromoterEventController::class, 'index'])->name('event.index');
        Route::post('/event', [PromoterEventController::class, 'store'])->name('event.store');
        Route::get('/event/{id}/edit', [PromoterEventController::class, 'edit'])->name('event.edit');
        Route::put('/event/{id}', [PromoterEventController::class, 'update'])->name('event.update');
        Route::delete('/gallery/{id}', [PromoterEventController::class, 'deleteGallery'])->name('event.deleteGallery');
    });

    // ==========================================
    // BUYER GROUP
    // ==========================================
    Route::group(['prefix' => 'buyer', 'as' => 'buyer.', 'middleware' => ['role:buyer']], function() {
        Route::get('/event', [BuyerEventController::class, 'index'])->name('event.index');
        Route::get('/event/{id}', [BuyerEventController::class, 'show'])->name('event.show');
    });

    // ==========================================
    // ORDER PROCESS (Shared Authenticated Users)
    // ==========================================
    Route::get('/order', [OrderController::class, 'index']);
    Route::post('/order', [OrderController::class, 'store']);
});