<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json([
        'status' => false,
        'message' => 'Akses tidak diizinkan',
    ], 401);
})->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/users', [UserController::class, 'getAll']);
    Route::get('/user/{id}', [UserController::class, 'getById']);
    Route::delete('/user/{id}', [UserController::class, 'deleteById']);
    Route::post('/user', [UserController::class, 'create']);
    Route::put('/user/{id}', [UserController::class, 'editIdentitasByUserId']);

    Route::get('/kos', [KosController::class, 'getAll']);
    Route::get('/kos/{id}', [KosController::class, 'getById']);
    Route::post('/kos', [KosController::class, 'create']);
    Route::delete('/kos/{id}', [KosController::class, 'deleteById']);

    Route::get('/customers', [CustomerController::class, 'getAll']);
    Route::get('/customer/kos/{id}', [CustomerController::class, 'getByKosId']);
    Route::get('/customer/{id}', [CustomerController::class, 'getById']);
});

Route::post('/login', [AuthController::class, 'login']);

// Route::post('/up-image', [InvoiceController::class, 'create']);