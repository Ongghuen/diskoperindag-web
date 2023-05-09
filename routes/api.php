<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiBeritaController;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [ApiAuthController::class, 'login']);
Route::get('/news', [ApiBeritaController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [ApiAuthController::class, 'logout']);
    Route::get('/me', [ApiAuthController::class, 'me']);

    Route::get('/news/saved', [ApiBeritaController::class, 'indexSaved']);
    Route::post('/news/add', [ApiBeritaController::class, 'store']);
    Route::delete('/news/delete/{id}', [ApiBeritaController::class, 'destroy']);
});
