<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\SertifikatController;


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
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('IsStay');
Route::post('/login', [AuthController::class, 'authenticate'])->middleware('IsStay');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('IsLogin');
Route::put('/change-password/{id}', [AuthController::class, 'changePassword'])->middleware('IsLogin');

# Users routes.
Route::get('/user', [UserController::class, 'index'])->middleware('IsLogin');
Route::post('/user', [UserController::class, 'store'])->middleware('IsLogin');
Route::get('/user-add', [UserController::class, 'storeView'])->middleware('IsLogin');
Route::get('/user-edit/{id}', [UserController::class, 'updateView'])->middleware('IsLogin');
Route::put('/user-update/{id}', [UserController::class, 'update'])->middleware('IsLogin');
Route::post('/user-destroy', [UserController::class, 'destroy'])->middleware('IsLogin');
Route::get('/user-bantuan/{id}', [UserController::class, 'addBantuan'])->middleware('IsLogin');
Route::post('/user-add-bantuan', [UserController::class, 'storeBantuan'])->middleware('IsLogin');
Route::get('/detail-user-bantuan/{id}', [UserController::class, 'detailuserbantuan'])->middleware('IsLogin');
Route::get('/delete-bantuan/{id}', [UserController::class, 'deleteBantuan'])->middleware('IsLogin');

# Admin routes.
Route::get('/admin', [AdminController::class, 'index'])->middleware('IsLogin', 'Session');
Route::post('/admin', [AdminController::class, 'store'])->middleware('IsLogin', 'Session');
Route::get('/admin-add', [AdminController::class, 'storeView'])->middleware('IsLogin','Session');
Route::post('/admin-destroy', [AdminController::class, 'destroy'])->middleware('IsLogin','Session');
Route::get('/admin-edit/{id}', [AdminController::class, 'updateView'])->middleware('IsLogin','Session');
Route::put('/admin-update/{id}', [AdminController::class, 'update'])->middleware('IsLogin','Session');
Route::get('/admin-detail/{id}', [AdminController::class, 'show'])->middleware('IsLogin','Session');
Route::get('/reset-pw/{id}', [AdminController::class, 'resetPassword'])->middleware('IsLogin','Session');

# Bantuan routes.
Route::get('/bantuan', [BantuanController::class, 'index'])->middleware('IsLogin');
Route::get('/bantuan-item/{id}', [BantuanController::class, 'addItem'])->middleware('IsLogin');
Route::post('/bantuan-add-item', [BantuanController::class, 'storeItem'])->middleware('IsLogin');
Route::get('delete-item/{item}/{bantuan}', [BantuanController::class, 'deleteItem'])->middleware('IsLogin');
Route::get('bantuan-detail/{id}', [BantuanController::class, 'detailbantuan'])->middleware('IsLogin');
Route::get('/bantuan-edit/{idBantuan}/{idUser}', [BantuanController::class, 'updateView'])->middleware('IsLogin');
Route::put('bantuan-update/{id}', [BantuanController::class, 'update'])->middleware('IsLogin');

# Pelatihan
Route::get('/pelatihan', [PelatihanController::class, 'index'])->middleware('IsLogin');
Route::get('/pelatihan-detail/{id}', [PelatihanController::class, 'detailPelatihan'])->middleware('IsLogin');
Route::post('/delete-pelatihan', [PelatihanController::class, 'destroy'])->middleware('IsLogin');
Route::get('/user-pelatihan', [PelatihanController::class, 'storeView'])->middleware('IsLogin');
Route::post('/pelatihan', [PelatihanController::class, 'store'])->middleware('IsLogin');
Route::get('/pelatihan-edit/{idPelatihan}', [PelatihanController::class, 'updateView'])->middleware('IsLogin');
Route::put('pelatihan-update/{id}', [PelatihanController::class, 'update'])->middleware('IsLogin');
Route::post('/pelatihan-add-user', [PelatihanController::class, 'addUser'])->middleware('IsLogin');
Route::get('/delete-user-pelatihan/{user}/{pelatihan}', [PelatihanController::class, 'deleteUser'])->middleware('IsLogin');

# Sertifikat
Route::get('/sertifikat', [SertifikatController::class, 'index'])->middleware('IsLogin');
Route::get('/sertifikat-detail/{id}', [SertifikatController::class, 'detailsertifikat'])->middleware('IsLogin');
Route::get('/delete-sertifikat/{id}', [SertifikatController::class, 'destroy'])->middleware('IsLogin');
Route::get('/user-sertifikat/{id}', [SertifikatController::class, 'storeView'])->middleware('IsLogin');
Route::post('/sertifikat', [SertifikatController::class, 'store'])->middleware('IsLogin');
Route::put('/sertifikat-update/{id}', [SertifikatController::class, 'update'])->middleware('IsLogin');
Route::get('/sertifikat-edit/{idSertifikat}/{idUser}', [SertifikatController::class, 'updateView'])->middleware('IsLogin');

# Item Routes
Route::get('/alatitem', [ItemController::class, 'index'])->middleware('IsLogin');
Route::post('/alatitem', [ItemController::class, 'store'])->middleware('IsLogin');
Route::put('/item-update/{id}', [ItemController::class, 'update'])->middleware('IsLogin');
Route::post('/item-destroy', [ItemController::class, 'destroy'])->middleware('IsLogin');
Route::get('/item-add', [ItemController::class, 'storeView'])->middleware('IsLogin');
Route::get('/item-edit/{id}', [ItemController::class, 'updateView'])->middleware('IsLogin');
Route::get('/item-detail/{id}', [ItemController::class, 'itemdetail'])->middleware('IsLogin');

# Berita Routes
Route::get('/berita', [BeritaController::class, 'index'])->middleware('IsLogin');
Route::get('/berita-detail/{id}', [BeritaController::class, 'beritadetail'])->middleware('IsLogin');
Route::get('/berita-edit/{id}', [BeritaController::class, 'editview'])->middleware('IsLogin');
Route::post('/beritatambah', [BeritaController::class, 'store'])->middleware('IsLogin');
Route::put('/berita-update/{id}', [BeritaController::class, 'update'])->middleware('IsLogin');
Route::post('/berita-destroy', [BeritaController::class, 'destroy'])->middleware('IsLogin');
Route::get('/berita-add', [BeritaController::class, 'storeView'])->middleware('IsLogin');
Route::get('/berita-restore', [BeritaController::class, 'restoreView'])->middleware('IsLogin');
Route::get('/berita-detail-deleted/{id}', [BeritaController::class, 'beritaDetailDeleted'])->middleware('IsLogin');
Route::post('/berita-force-destroy', [BeritaController::class, 'forceDestroy'])->middleware('IsLogin');
Route::get('/berita-pulihkan/{id}', [BeritaController::class, 'restore'])->middleware('IsLogin');

# Notifikasi Routes
Route::get('/notifikasi', [NotifikasiController::class, 'create'])->middleware('IsLogin');
Route::post('/notifikasi/add', [NotifikasiController::class, 'store'])->middleware('IsLogin');

# Report Routes
Route::get('/report', [ReportController::class, 'index'])->middleware('IsLogin');
Route::get('/export', [ReportController::class, 'export'])->middleware('IsLogin');
