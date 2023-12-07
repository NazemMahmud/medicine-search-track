<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', function (Request $request) {
    return response()->json(['success' => 'Healthcheck success']);
});

Route::post('register', [AuthController::class, 'registration'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
