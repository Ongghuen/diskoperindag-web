<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BantuanController;
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
Route::get('delete-bantuan/{id}', [UserController::class, 'deleteBantuan'])->middleware('auth');

# Bantuan routes.
Route::get('/bantuan', [BantuanController::class, 'index'])->middleware('auth');
Route::get('/bantuan-item/{id}', [BantuanController::class, 'addItem'])->middleware('auth');
Route::post('/bantuan-add-item', [BantuanController::class, 'storeItem'])->middleware('auth');
Route::get('delete-item/{item}/{bantuan}', [BantuanController::class, 'deleteItem'])->middleware('auth');
Route::get('bantuan-detail/{id}', [BantuanController::class, 'detailbantuan'])->middleware('auth');

# Pelatihan
Route::get('/pelatihan', [PelatihanController::class, 'index'])->middleware('auth');
// Route::post('/pelatihanitem', [PelatihanController::class, 'store'])->middleware('auth');
// Route::put('pelatihan-update/{id}', [PelatihanController::class, 'update'])->middleware('auth');
// Route::delete('/pelatihan-destroy/{id}', [PelatihanController::class, 'destroy'])->middleware('auth');
// Route::get('/pelatihan-add', [PelatihanController::class, 'storeView'])->middleware('auth');
// Route::get('/pelatihan-edit/{id}', [PelatihanController::class, 'updateView'])->middleware('auth');
// Route::get('/pelatihan-detail/{id}', [PelatihanController::class, 'pelatihandetail'])->middleware('auth');

# Sertifikat
Route::get('/sertifikat', [SertifikatController::class, 'index'])->middleware('auth');
Route::get('/sertifikat-detail/{id}', [SertifikatController::class, 'detailsertifikat'])->middleware('auth');
// Route::post('/sertifikatitem', [SertifikatController::class, 'store'])->middleware('auth');
// Route::put('sertifikat-update/{id}', [SertifikatController::class, 'update'])->middleware('auth');
// Route::delete('/sertifikat-destroy/{id}', [SertifikatController::class, 'destroy'])->middleware('auth');
// Route::get('/sertifikat-add', [SertifikatController::class, 'storeView'])->middleware('auth');
// Route::get('/sertifikat-edit/{id}', [SertifikatController::class, 'updateView'])->middleware('auth');

# Item Routes
Route::get('/alatitem', [ItemController::class, 'index'])->middleware('auth');
Route::post('/alatitem', [ItemController::class, 'store'])->middleware('auth');
Route::put('/item-update/{id}', [ItemController::class, 'update'])->middleware('auth');
Route::delete('/item-destroy/{id}', [ItemController::class, 'destroy'])->middleware('auth');
Route::get('/item-add', [ItemController::class, 'storeView'])->middleware('auth');
Route::get('/item-edit/{id}', [ItemController::class, 'updateView'])->middleware('auth');
Route::get('/item-detail/{id}', [ItemController::class, 'itemdetail'])->middleware('auth');

# Report Routes
Route::get('/report', [ReportController::class, 'index'])->middleware('auth');
Route::get('/export', [ReportController::class, 'export'])->middleware('auth');
