<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/beritas', BeritaController::class);
Route::resource('/', BeritaController::class);
