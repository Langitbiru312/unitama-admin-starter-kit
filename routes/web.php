<?php

use App\Http\Controllers\DasboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ DasboardController::class, 'index'])->name('dasboard.index');
Route::resource('/user', UserController::class);
// Ganti baris 9-11 di routes/web.php Anda dengan ini:
Route::get('/dasboard', [DasboardController::class, 'index'])->name('dasboard');