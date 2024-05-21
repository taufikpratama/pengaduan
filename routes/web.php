<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TindakanController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
Route::get('/pengaduan/show', [PengaduanController::class, 'show'])->name('pengaduan.show');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
Route::get('/pengaduan/masyarakat', [PengaduanController::class, 'pengaduanMasyarakat'])->name('pengaduan.masyarakat')->middleware('auth');
Route::get('/pengaduan/{id}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
Route::Post('/pengaduan/update/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update');
Route::delete('/pengaduan/{pengaduan}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
Route::get('/pengaduan/selesai', [PengaduanController::class, 'selesai'])->name('pengaduan.selesai');

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit'); // Tambahkan parameter user
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // Tambahkan parameter user
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update'); // Tambahkan parameter user
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
});

// routes/web.php
Route::get('tindakan/show', [TindakanController::class, 'show'])->name('pengaduan.tindakan.show');
Route::get('pengaduan/{pengaduan}/tindakan/create', [TindakanController::class, 'create'])->name('pengaduan.tindakan.create');
Route::post('pengaduan/tindakan', [TindakanController::class, 'store'])->name('pengaduan.tindakan.store');
Route::get('pengaduan/{pengaduan}/tindakan/{tindakan}/edit', [TindakanController::class, 'edit'])->name('pengaduan.tindakan.edit');
Route::put('pengaduan/{pengaduan}/tindakan/{tindakan}', [TindakanController::class, 'update'])->name('pengaduan.tindakan.update');
Route::delete('pengaduan/{pengaduan}/tindakan/{tindakan}', [TindakanController::class, 'destroy'])->name('pengaduan.tindakan.destroy');
Route::get('/tindakan/tambah/{pengaduanId}', [TindakanController::class, 'tambah'])->name('tindakan.tambah');
Route::get('/tindakan/{tindakan}/tindakan/upload', 'TindakanController@uploadLaporan')->name('tindakan.upload.laporan');
Route::post('/pengaduan/{pengaduan}/tindakan/{tindakan}/selesai', [TindakanController::class, 'selesaiTindakan'])->name('pengaduan.tindakan.selesai');


require __DIR__.'/auth.php';