<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Event; 

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

// Import Controller Buyer
use App\Http\Controllers\buyer\OrderController; 
use App\Http\Controllers\buyer\EventController as BuyerEventController;

// Import Controller Khusus Super Admin
use App\Http\Controllers\super_admin\DashboardController;
use App\Http\Controllers\super_admin\TransactionController;
use App\Http\Controllers\super_admin\EventController as SuperEventController;
use App\Http\Controllers\super_admin\AdminController; 
use App\Http\Controllers\super_admin\ReportController;

// Import Controller Promoter
use App\Http\Controllers\promoter\EventController as PromoterEventController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $events = Event::with('ticketTypes')->get(); 
    return view('welcome', compact('events'));
});

// Privacy Policy & Terms of Service
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy.policy');

Route::get('/terms-of-service', function () {
    return view('terms-of-service');
})->name('terms.service');

Route::get('/ticket-selling-guide', function () {
    return view('ticket-selling-guide');
})->name('ticket.guide');

// Detail Event
Route::get('/events', [BuyerEventController::class, 'search'])->name('events.search');
Route::get('/event/{id}', [BuyerEventController::class, 'show'])->name('event.show');

// Midtrans Payment Webhook (Notifikasi Otomatis dari Server Midtrans)
Route::post('/buyer/payment/notification', [OrderController::class, 'paymentNotification']);


/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/
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
| PROFILE & PROMOTER APPLY
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Promoter Apply
    Route::get('/promoter/apply', [ProfileController::class, 'applyPromoter'])->name('promoter.apply');
    Route::post('/promoter/apply/store', [ProfileController::class, 'storePromoterApplication'])->name('promoter.apply.store');
});


/*
|--------------------------------------------------------------------------
| PROTECTED DASHBOARD ROUTES (SHARED ACCESSIBILITY)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'role:buyer,promoter,super_admin']);


/*
|--------------------------------------------------------------------------
| ROLE-BASED ROUTES (AUTHENTICATED USERS)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // ====================================================================
    // SUPER ADMIN GROUP (Fixed Role: super_admin)
    // ====================================================================
    Route::group(['prefix' => 'super', 'as' => 'super.', 'middleware' => ['role:super_admin']], function() {
        
        // Analytics & Reports
        Route::get('/', [DashboardController::class, 'summary'])->name('dashboard');
        Route::get('/summary', [DashboardController::class, 'summary'])->name('summary');
        Route::get('/reports', [DashboardController::class, 'reports'])->name('reports.index');
        Route::get('/export', [DashboardController::class, 'export'])->name('export');
        Route::get('/reports/{id}', [DashboardController::class, 'showReport'])->name('reports.detail');
        
        // Transactions Management
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/transactions/event/{id}', [TransactionController::class, 'eventList'])->name('transactions.eventList');
        Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');

        // Event Management & Approval Action
        Route::get('/event', [SuperEventController::class, 'index'])->name('events.index');
        Route::get('/events/{id}', [SuperEventController::class, 'show'])->name('events.show'); 
        Route::patch('/event/{id}/approve', [SuperEventController::class, 'approve'])->name('event.approve');
        Route::patch('/event/{id}/reject', [SuperEventController::class, 'reject'])->name('event.reject');
        Route::delete('/event/{id}', [SuperEventController::class, 'destroy'])->name('event.destroy');

        // Approval Promoter
        Route::get('/promoter-requests', [AdminController::class, 'promoterRequests'])->name('promoter.requests');
        Route::post('/promoter-requests/{id}/action', [AdminController::class, 'handlePromoterRequest'])->name('promoter.action');
        
        // Export Laporan
        Route::get('/report', [ReportController::class, 'index'])->name('report');
        Route::get('/report/export', [ReportController::class, 'export'])->name('export');
    });

    // ====================================================================
    // PROMOTER GROUP
    // ====================================================================
    Route::group(['prefix' => 'promoter', 'as' => 'promoter.', 'middleware' => ['role:promoter']], function() {
        Route::get('/', [App\Http\Controllers\promoter\PromoterDashboardController::class, 'summary'])->name('dashboard');
        Route::get('/event', [PromoterEventController::class, 'index'])->name('event.index');
        Route::post('/event', [PromoterEventController::class, 'store'])->name('event.store');
        Route::get('/event/create', [PromoterEventController::class, 'create'])->name('event.create');
        Route::get('/event/{id}/edit', [PromoterEventController::class, 'edit'])->name('event.edit');
        Route::put('/event/{id}', [PromoterEventController::class, 'update'])->name('event.update');
        Route::delete('/event/{id}', [PromoterEventController::class, 'destroy'])->name('event.destroy');
        Route::delete('/gallery/{id}', [PromoterEventController::class, 'deleteGallery'])->name('event.deleteGallery');

        // Reports
        Route::get('/reports', [App\Http\Controllers\promoter\PromoterDashboardController::class, 'reports'])->name('reports');
        Route::get('/reports/export', [App\Http\Controllers\promoter\PromoterDashboardController::class, 'export'])->name('reports.export');
    });

    // ====================================================================
    // BUYER GROUP - ✅ FIXED (DUPLIKASI DIHAPUS)
    // ====================================================================
    Route::group(['prefix' => 'buyer', 'as' => 'buyer.', 'middleware' => ['role:buyer']], function() {
        
        // Event Listing
        Route::get('/event', [BuyerEventController::class, 'index'])->name('event.index');

        // STEP 1: Pilih Kategori & Jumlah Tiket
        Route::get('/event/{id}/select-ticket', [BuyerEventController::class, 'selectTicket'])->name('ticket.select');
        Route::post('/event/{id}/select-ticket', [BuyerEventController::class, 'saveTicketSelection'])->name('ticket.select.store');

        // STEP 2: Isi Data Diri Pemegang Tiket
        Route::get('/event/{id}/checkout', [BuyerEventController::class, 'checkoutForm'])->name('checkout.form');
        Route::post('/event/{id}/checkout', [OrderController::class, 'checkoutStore'])->name('checkout.store');

        // STEP 3: Ringkasan Transaksi (Summary)
        Route::get('/order/review/{eventId}', [OrderController::class, 'reviewOrder'])->name('order.review');

        // STEP 4: Proses Generate Token Midtrans & Save DB tabel Orders
        Route::post('/order/store/{eventId}', [OrderController::class, 'store'])->name('order.store');

        // STEP 5: Tampilan Halaman Bayar Pop-Up QRIS & Simulasi
        Route::get('/order/payment/{id}', [OrderController::class, 'paymentPage'])->name('order.payment');
        Route::get('/order/payment/{id}/simulate-success', [OrderController::class, 'simulateSuccess'])->name('order.payment.simulate');

        // STEP 6: Tampilan Cetak E-Tiket
        Route::get('/order/{id}/ticket', [OrderController::class, 'viewTicket'])->name('order.ticket');
        Route::get('/order/{id}/ticket/offline', [OrderController::class, 'viewOfflineTicket'])->name('order.ticket.offline');

        // BONUS: Cek Status Transaksi Manual (Debugging)
        Route::get('/order/{id}/check-status', [OrderController::class, 'checkStatus'])->name('order.checkStatus');
    });

});