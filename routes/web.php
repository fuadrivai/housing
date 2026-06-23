<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HouseController;
use Illuminate\Support\Facades\Route;

Route::middleware(['prevent-back-history'])->group(function () {

    Route::get('auth', [AuthController::class, 'index'])->middleware('guest')->name('login');
    Route::post('auth', [AuthController::class, 'authenticate'])->middleware('guest')->name('authenticate');
    
    Route::group(['middleware' => 'auth'], function () {
        
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('register', [AuthController::class, 'register'])->name('register');

        Route::prefix('houses')->name('house.')->group(function () {
            Route::resource('', HouseController::class)->parameters(['' => 'house']);
        });

        Route::prefix('year')->name('year.')->group(function () {
            Route::resource('', AcademicYearController::class)->parameters(['' => 'academicYear']);
        });
    });
});
