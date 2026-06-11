<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;


/*
|--------------------------------------------------------------------------
| BASIC TEST API
|--------------------------------------------------------------------------
*/

Route::get('/test', function () {
    return response()->json([
        'message' => 'API Tiketara aktif'
    ]);
});


/*
|--------------------------------------------------------------------------
| AUTH API
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


/*
|--------------------------------------------------------------------------
| AUTH SANCTUM (PROTECTED)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);

});


/*
|--------------------------------------------------------------------------
| EVENT API (CRUD)
|--------------------------------------------------------------------------
*/

Route::get('/event', [EventController::class, 'apiIndex']);

Route::post('/event', [EventController::class, 'apiStore']);

Route::put('/event/{id}', [EventController::class, 'apiUpdate']);

Route::delete('/event/{id}', [EventController::class, 'apiDestroy']);


/*
|--------------------------------------------------------------------------
| EVENT ACTION (BUSINESS LOGIC)
|--------------------------------------------------------------------------
*/

Route::post('/event/{id}/approve', [EventController::class, 'approve']);

Route::post('/event/{id}/reject', [EventController::class, 'reject']);