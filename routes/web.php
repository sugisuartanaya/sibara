<?php

use App\Http\Controllers\BarangRampasanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PenawaranController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index']);

Route::get('/account/login', [LoginController::class, 'index']);
Route::post('/account/login', [LoginController::class, 'authenticate'])->name('login')->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/account/register', [RegisterController::class, 'index']);
Route::post('/account/register', [RegisterController::class, 'store']);

Route::get('/account/profile', [PembeliController::class, 'index']);
Route::put('/account/updateNotelp/{id}', [PembeliController::class, 'updateProfileData']);
Route::put('/account/updatePassword/{id}', [PembeliController::class, 'updatePassword']);
Route::get('/account/penawaran', [PembeliController::class, 'showPenawaran'])->name('showPenawaran');

Route::put('/account/profile/{username}', [PembeliController::class, 'updateProfile']);
Route::get('/update-data/{username}', [PembeliController::class, 'updateData']);

Route::get('/barang', [BarangRampasanController::class, 'index']);
Route::get('/filter', [BarangRampasanController::class, 'filter']);

Route::get('/detail/{id}', [BarangRampasanController::class, 'checkTypeBid']);

Route::post('/penawaran', [PenawaranController::class, 'store']);
Route::put('/penawaran/{id}', [PenawaranController::class, 'update']);

Route::get('/jadwal', [JadwalController::class, 'index']);

Route::get('/pengumuman', [PengumumanController::class, 'index']);

Route::get('/pembayaran', [TransaksiController::class, 'payment'])->middleware('auth');
Route::get('/transaksi', [TransaksiController::class, 'transaction'])->middleware('auth');
Route::get('/invoice/{id}', [TransaksiController::class, 'invoice'])->middleware('auth');
Route::get('/revisi/{id}', [TransaksiController::class, 'revisi'])->middleware('auth');
Route::post('/pembayaran/{id}', [TransaksiController::class, 'upload'])->middleware('auth');
Route::put('/pembayaran/revisi/{id}', [TransaksiController::class, 'uploadRevisi'])->middleware('auth');
