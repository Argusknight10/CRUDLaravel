<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RegisterController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/berita', [HomeController::class, 'berita']);
Route::resource('/detail', HomeController::class);

Route::resource('/beritas', BeritaController::class);
// Route::get('/beritas/id', [BeritaController::class, 'show'])->middleware('');
Route::resource('/users', UserController::class)->middleware('auth');
Route::resource('/kategoris', KategoriController::class)->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::resource('/register', RegisterController::class)->middleware('guest');

