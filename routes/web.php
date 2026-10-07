<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CeritaController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/cerita', [CeritaController::class, 'index'])->name('cerita.index');
Route::get('/cerita/{cerita}', [CeritaController::class, 'show'])->name('cerita.show');

Route::get('/kategori/{kategori:slug}', [CeritaController::class, 'kategori'])->name('kategori.show');
Route::get('/genre/{tag:slug}', [CeritaController::class, 'genre'])->name('genre.show');