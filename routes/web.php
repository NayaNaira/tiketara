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

Route::get('/email/verify', fn () => view('auth.verify-email'))
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

Route::get('/promoter', fn () => view('promoter.dashboard'))
    ->middleware(['auth', 'role:promoter,super_admin']);

Route::prefix('super')->middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\SuperAdminController::class, 'events'])->name('super.events.index');
    Route::get('/summary', [App\Http\Controllers\SuperAdminController::class, 'summary'])->name('super.summary');
    Route::get('/events/{id}', [App\Http\Controllers\SuperAdminController::class, 'eventDetail'])->name('super.events.show');
    Route::get('/transactions', [App\Http\Controllers\SuperAdminController::class, 'transactions'])->name('super.transactions.index');
    Route::get('/transactions/{id}', [App\Http\Controllers\SuperAdminController::class, 'transactionDetail'])->name('super.transactions.show');
    Route::get('/reports', [App\Http\Controllers\SuperAdminController::class, 'reports'])->name('super.reports.index');
    Route::get('/export', [App\Http\Controllers\SuperAdminController::class, 'export'])->name('super.export');
});

Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'role:pembeli,promoter,super_admin']);


/*
|--------------------------------------------------------------------------
| EVENT (WEB VIEW ONLY)
|--------------------------------------------------------------------------
*/
Route::get('/event', [EventController::class, 'index'])
    ->name('event');

Route::post('/event', [EventController::class, 'store'])
    ->name('event.store');

Route::get('/event/{id}/edit', [EventController::class, 'edit'])
    ->name('event.edit');

Route::put('/event/{id}', [EventController::class, 'update'])
    ->name('event.update');

Route::delete('/event/{id}', [EventController::class, 'destroy'])
    ->name('event.destroy');

Route::post('/event/{event}/gallery', [EventGalleryController::class, 'store'])
    ->middleware(['auth', 'role:promoter']);

Route::delete('/event/{event}/gallery/{gallery}', [EventGalleryController::class, 'destroy'])
    ->middleware(['auth', 'role:promoter']);

Route::get('/ticket-types', [TicketTypeController::class, 'index'])
    ->name('ticket-types.index');
Route::post('/ticket-types', [TicketTypeController::class, 'store'])
    ->name('ticket-types.store');
