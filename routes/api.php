<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicineController;


Route::post('register', [AuthController::class, 'registration'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('medicine-search', [MedicineController::class, 'searchMedicine'])->name('medicine-search');
