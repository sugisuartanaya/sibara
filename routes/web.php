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
Route::post('/account/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/account/register', [RegisterController::class, 'index']);
Route::post('/account/register', [RegisterController::class, 'store']);

Route::get('/account/profile', [PembeliController::class, 'myProfile']);
Route::put('/account/profile/{username}', [PembeliController::class, 'updateProfile']);
Route::get('/update-data/{username}', [PembeliController::class, 'updateData']);

Route::get('/barang', [BarangRampasanController::class, 'index']);
Route::get('/filter', [BarangRampasanController::class, 'filter']);

Route::get('/detail/{id}', [BarangRampasanController::class, 'show']);

Route::post('/penawaran', [PenawaranController::class, 'store']);
Route::put('/penawaran/{id}', [PenawaranController::class, 'update']);

Route::get('/jadwal', [JadwalController::class, 'index']);

Route::get('/pengumuman', [PengumumanController::class, 'index']);