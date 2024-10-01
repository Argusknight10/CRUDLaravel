<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return view('home', ['title' => 'HOME PAGE']);
}); 

Route::resource('/beritas', BeritaController::class);
Route::resource('/kategoris', KategoriController::class);

