<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

# Auth routes.
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

# Dashboard routes.
Route::get('/user', [UserController::class, 'index'])->middleware('auth');
Route::post('/user', [UserController::class, 'store'])->middleware('auth');
Route::delete('/user-destroy/{id}', [UserController::class, 'destroy'])->middleware('auth');
Route::put('/user-update/{id}', [UserController::class, 'update'])->middleware('auth');
