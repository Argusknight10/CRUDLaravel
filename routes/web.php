<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return view('home', ['title' => 'HOME PAGE']);
}); 

Route::resource('/beritas', BeritaController::class);
Route::resource('/kategoris', KategoriController::class);
// Route::get('/login', [LoginController::class, 'login']);
// Route::get('/register', [RegisterController::class, 'register']);

