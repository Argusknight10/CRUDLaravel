<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;

Route::get('/', function () {
    return view('home', ['title' => 'HOME PAGE']);
}); 

Route::resource('/beritas', BeritaController::class);
// Route::resource('/', BeritaController::class);
