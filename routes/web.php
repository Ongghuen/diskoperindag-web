<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\BeritaController;


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

# Users routes.
Route::get('/user', [UserController::class, 'index'])->middleware('auth');
Route::post('/user', [UserController::class, 'store'])->middleware('auth');
Route::get('/user-add', [UserController::class, 'storeView'])->middleware('auth');
Route::get('/user-edit/{id}', [UserController::class, 'updateView'])->middleware('auth');
Route::put('/user-update/{id}', [UserController::class, 'update'])->middleware('auth');
Route::delete('/user-destroy/{id}', [UserController::class, 'destroy'])->middleware('auth');
Route::get('/user-bantuan/{id}', [UserController::class, 'addBantuan'])->middleware('auth');
Route::post('/user-add-bantuan', [UserController::class, 'storeBantuan'])->middleware('auth');
Route::get('/detail-user-bantuan/{id}', [UserController::class, 'detailuserbantuan'])->middleware('auth');
Route::get('/delete-bantuan/{id}', [UserController::class, 'deleteBantuan'])->middleware('auth');
Route::get('/umur0-20', [UserController::class, 'nolDuaPuluh'])->middleware('auth');
Route::get('/umur21-30', [UserController::class, 'duaSatuTigaPuluh'])->middleware('auth');
Route::get('/umur31-40', [UserController::class, 'tigaSatuEmpatPuluh'])->middleware('auth');
Route::get('/umur41-50', [UserController::class, 'empatSatuLimaPuluh'])->middleware('auth');
Route::get('/umur51++', [UserController::class, 'limaSatuPlus'])->middleware('auth');

# Bantuan routes.
Route::get('/bantuan', [BantuanController::class, 'index'])->middleware('auth');
Route::get('/bantuan-item/{id}', [BantuanController::class, 'addItem'])->middleware('auth');
Route::post('/bantuan-add-item', [BantuanController::class, 'storeItem'])->middleware('auth');
Route::get('delete-item/{item}/{bantuan}', [BantuanController::class, 'deleteItem'])->middleware('auth');
Route::get('bantuan-detail/{id}', [BantuanController::class, 'detailbantuan'])->middleware('auth');
Route::get('/bantuan-edit/{idBantuan}/{idUser}', [BantuanController::class, 'updateView'])->middleware('auth');
Route::put('bantuan-update/{id}', [BantuanController::class, 'update'])->middleware('auth');

# Pelatihan
Route::get('/pelatihan', [PelatihanController::class, 'index'])->middleware('auth');
Route::get('/pelatihan-detail/{id}', [PelatihanController::class, 'detailPelatihan'])->middleware('auth');
Route::get('/delete-pelatihan/{id}', [PelatihanController::class, 'destroy'])->middleware('auth');
Route::get('/user-pelatihan/{id}', [PelatihanController::class, 'storeView'])->middleware('auth');
Route::post('/pelatihan', [PelatihanController::class, 'store'])->middleware('auth');
Route::get('/pelatihan-edit/{idPelatihan}/{idUser}', [PelatihanController::class, 'updateView'])->middleware('auth');
Route::put('pelatihan-update/{id}', [PelatihanController::class, 'update'])->middleware('auth');

# Sertifikat
Route::get('/sertifikat', [SertifikatController::class, 'index'])->middleware('auth');
Route::get('/sertifikat-detail/{id}', [SertifikatController::class, 'detailsertifikat'])->middleware('auth');
Route::get('/delete-sertifikat/{id}', [SertifikatController::class, 'destroy'])->middleware('auth');
Route::get('/user-sertifikat/{id}', [SertifikatController::class, 'storeView'])->middleware('auth');
Route::post('/sertifikat', [SertifikatController::class, 'store'])->middleware('auth');
Route::put('/sertifikat-update/{id}', [SertifikatController::class, 'update'])->middleware('auth');
Route::get('/sertifikat-edit/{idSertifikat}/{idUser}', [SertifikatController::class, 'updateView'])->middleware('auth');

# Item Routes
Route::get('/alatitem', [ItemController::class, 'index'])->middleware('auth');
Route::post('/alatitem', [ItemController::class, 'store'])->middleware('auth');
Route::put('/item-update/{id}', [ItemController::class, 'update'])->middleware('auth');
Route::delete('/item-destroy/{id}', [ItemController::class, 'destroy'])->middleware('auth');
Route::get('/item-add', [ItemController::class, 'storeView'])->middleware('auth');
Route::get('/item-edit/{id}', [ItemController::class, 'updateView'])->middleware('auth');
Route::get('/item-detail/{id}', [ItemController::class, 'itemdetail'])->middleware('auth');

# Item Routes
Route::get('/berita', [BeritaController::class, 'index'])->middleware('auth');
Route::get('/berita-detail/{id}', [BeritaController::class, 'beritadetail'])->middleware('auth');
Route::get('/berita-edit/{id}', [BeritaController::class, 'editview'])->middleware('auth');
Route::post('/beritatambah', [BeritaController::class, 'store'])->middleware('auth');
Route::put('/berita-update/{id}', [BeritaController::class, 'update'])->middleware('auth');
Route::delete('/berita-destroy/{id}', [BeritaController::class, 'destroy'])->middleware('auth');
Route::get('/berita-add', [BeritaController::class, 'storeView'])->middleware('auth');
// Route::get('/item-edit/{id}', [ItemController::class, 'updateView'])->middleware('auth');
// Route::get('/item-detail/{id}', [ItemController::class, 'itemdetail'])->middleware('auth');

# Report Routes
Route::get('/report', [ReportController::class, 'index'])->middleware('auth');
Route::get('/export', [ReportController::class, 'export'])->middleware('auth');
