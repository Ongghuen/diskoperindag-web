<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControllerApi;

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

Route::middleware(['auth:sanctum'])->group(function () {
    //auth
    Route::get('/logout', [AuthControllerApi::class, 'logout']);
    Route::get('/me', [AuthControllerApi::class, 'me']);
});

Route::post('/login', [AuthControllerApi::class, 'login']);
