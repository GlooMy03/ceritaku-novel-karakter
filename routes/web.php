<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CeritaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaryaController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/cerita', [CeritaController::class, 'index'])->name('cerita.index');
Route::get('/cerita/{cerita}', [CeritaController::class, 'show'])->name('cerita.show');

Route::get('/kategori/{kategori:slug}', [CeritaController::class, 'kategori'])->name('kategori.show');
Route::get('/genre/{tag:slug}', [CeritaController::class, 'genre'])->name('genre.show');

Route::middleware('guest')->group(function () {
    Route::get('/daftar', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/daftar', [AuthController::class, 'register']);
    Route::get('/masuk', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/masuk', [AuthController::class, 'login']);
});

Route::post('/keluar', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->prefix('karya')->name('karya.')->group(function () {
    Route::get('/', [KaryaController::class, 'index'])->name('index');
    Route::get('/buat', [KaryaController::class, 'create'])->name('create');
    Route::post('/', [KaryaController::class, 'store'])->name('store');
    Route::get('/{cerita}/edit', [KaryaController::class, 'edit'])->name('edit');
    Route::put('/{cerita}', [KaryaController::class, 'update'])->name('update');
    Route::delete('/{cerita}', [KaryaController::class, 'destroy'])->name('destroy');
});