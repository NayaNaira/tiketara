<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AcaraController;


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
| ACARA API (CRUD)
|--------------------------------------------------------------------------
*/

Route::get('/acara', [AcaraController::class, 'apiIndex']);

Route::post('/acara', [AcaraController::class, 'apiStore']);

Route::put('/acara/{id}', [AcaraController::class, 'apiUpdate']);

Route::delete('/acara/{id}', [AcaraController::class, 'apiDestroy']);


/*
|--------------------------------------------------------------------------
| ACARA ACTION (BUSINESS LOGIC)
|--------------------------------------------------------------------------
*/

Route::post('/acara/{id}/approve', [AcaraController::class, 'approve']);

Route::post('/acara/{id}/reject', [AcaraController::class, 'reject']);