<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\UsersMedicationController;

Route::post('register', [AuthController::class, 'registration'])->name('register');

Route::group(['middleware' => 'throttle:api,' . env('RATE_LIMIT_REQUEST_LIMIT', 60) . ',' . env('RATE_LIMIT_REQUEST_TIME', 1)], function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::get('medicine-search', [MedicineController::class, 'searchMedicine'])->name('medicine-search');

    Route::middleware(['jwt.verify'])->group(function () {

        Route::prefix('user')->group(function () {
            Route::post('/add-medicine', [UsersMedicationController::class, 'store'])->name('med.store');
            Route::get('/medicines', [UsersMedicationController::class, 'index'])->name('med.index');
            Route::delete('/delete-medicine/{rxcui}', [UsersMedicationController::class, 'destroy'])->name('med.delete');
        });
    });
});
