<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::post('register', [AuthController::class, 'registration'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
