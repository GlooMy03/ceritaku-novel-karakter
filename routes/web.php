<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CeritaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;


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