<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiBeritaController;
use App\Http\Controllers\ApiFasilitasiController;
use App\Http\Controllers\ApiSuratController;
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

// public api, i guess
Route::post('/login', [ApiAuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    // auth
    Route::get('/logout', [ApiAuthController::class, 'logout']);
    Route::get('/checkToken', [ApiAuthController::class, 'checkToken']);
    Route::post('/changePassword', [ApiAuthController::class, 'changePassword']);

    // berita
    Route::post('/news/add', [ApiBeritaController::class, 'store']);
    Route::get('/news/saved', [ApiBeritaController::class, 'indexSaved']);
    Route::delete('/news/delete/{id}', [ApiBeritaController::class, 'destroy']);

    // fasilitasi
    Route::get('/fasilitasi/bantuan', [ApiFasilitasiController::class, 'bantuan']);
    Route::get('/fasilitasi/bantuan/{id}', [ApiFasilitasiController::class, 'bantuanDetail']);
    Route::get('/fasilitasi/sertifikat', [ApiFasilitasiController::class, 'sertifikat']);
    Route::get('/fasilitasi/pelatihan', [ApiFasilitasiController::class, 'pelatihan']);

    // surat
    Route::get('/surat', [ApiSuratController::class, 'index']);
    Route::post('/surat', [ApiSuratController::class, 'store']);
});

Route::get('/news', [ApiBeritaController::class, 'index']);
Route::get('/news/{id}', [ApiBeritaController::class, 'detail']);
