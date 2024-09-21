<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\TempRegisterUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::controller(TempRegisterUserController::class)->prefix('temp-register')->name('tempRegister')->group(function() {
        Route::get('/', 'create')->name('.create');
        Route::post('/', 'store');
        Route::get('/complate', 'comp')->name('.comp');
    });

    Route::controller(RegisterUserController::class)->prefix('register')->name('register')->group(function() {
        Route::get('/', 'store')->name('.store');
    });

    Route::controller(AuthenticatedSessionController::class)->group(function() {
        Route::get('login', 'create')->name('login');
        Route::post('login', 'store');
    });
});

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);
