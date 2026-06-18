<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventGalleryController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\super_admin\EventController as SuperEventController;
use App\Http\Controllers\promoter\EventController as PromoterEventController;
use App\Http\Controllers\buyer\EventController as BuyerEventController;
/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => view('welcome'));


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

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
| EMAIL VERIFICATION
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
| DASHBOARD (WEB)
|--------------------------------------------------------------------------
*/

Route::get('/promoter', fn () => view('.dashboard'))
    ->middleware(['auth', 'role:promoter,super_admin']);

Route::prefix('super')->middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\SuperAdminController::class, 'events'])->name('super.events.index');
    Route::get('/summary', [App\Http\Controllers\SuperAdminController::class, 'summary'])->name('super.summary');
    Route::get('/events/{id}', [App\Http\Controllers\SuperAdminController::class, 'eventDetail'])->name('super.events.show');
    Route::get('/transactions', [App\Http\Controllers\SuperAdminController::class, 'transactions'])->name('super.transactions.index');
    Route::get('/transactions/event/{id}', [App\Http\Controllers\SuperAdminController::class, 'transactionEventList'])->name('super.transactions.list');
    Route::get('/transactions/{id}', [App\Http\Controllers\SuperAdminController::class, 'transactionDetail'])->name('super.transactions.show');
    Route::get('/reports', [App\Http\Controllers\SuperAdminController::class, 'reports'])->name('super.reports.index');
    Route::get('/export', [App\Http\Controllers\SuperAdminController::class, 'export'])->name('super.export');
});

Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'role:buyer,promoter,super_admin']);


Route::middleware(['auth'])->group(function () {

    // ==========================================
    // GRUP SUPER ADMIN
    // ==========================================
    Route::group(['prefix' => 'super', 'as' => 'super.', 'middleware' => ['role:super-admin']], function() {
        Route::get('/event', [SuperEventController::class, 'index'])->name('event.index');
        Route::patch('/event/{id}/approve', [SuperEventController::class, 'approve'])->name('event.approve');
        Route::patch('/event/{id}/reject', [SuperEventController::class, 'reject'])->name('event.reject');
        Route::delete('/event/{id}', [SuperEventController::class, 'destroy'])->name('event.destroy');
    });

    // ==========================================
    // GRUP PROMOTER
    // ==========================================
    Route::group(['prefix' => 'promoter', 'as' => 'promoter.', 'middleware' => ['role:promoter']], function() {
        Route::get('/event', [PromoterEventController::class, 'index'])->name('event.index');
        Route::post('/event', [PromoterEventController::class, 'store'])->name('event.store');
        Route::get('/event/{id}/edit', [PromoterEventController::class, 'edit'])->name('event.edit');
        Route::put('/event/{id}', [PromoterEventController::class, 'update'])->name('event.update');
        Route::delete('/gallery/{id}', [PromoterEventController::class, 'deleteGallery'])->name('event.deleteGallery');
    });

    // ==========================================
    // GRUP BUYER
    // ==========================================
    Route::group(['prefix' => 'buyer', 'as' => 'buyer.', 'middleware' => ['role:buyer']], function() {
        Route::get('/event', [BuyerEventController::class, 'index'])->name('event.index');
        Route::get('/event/{id}', [BuyerEventController::class, 'show'])->name('event.show');
    });
});

Route::get('/order', [OrderController::class, 'index']);
Route::post('/order', [OrderController::class, 'store']);

