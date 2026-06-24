<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PersonController;
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
            Route::PATCH('/activated', [AcademicYearController::class, 'toggleActive'])->name('toggleActive');
            Route::resource('', AcademicYearController::class)->parameters(['' => 'academicYear']);
        });

        Route::prefix('person')->name('person.')->group(function () {
            Route::get('/no-member/{yearId}/{houseId}', [PersonController::class, 'getPeopleNoMember'])->name('getPeopleNoMember');
            Route::resource('', PersonController::class)->parameters(['' => 'person']);
        });

        Route::prefix('branch')->name('branch.')->group(function () {
            Route::resource('', BranchController::class)->parameters(['' => 'branch']);
        });

        Route::prefix('organization')->name('organization.')->group(function () {
            Route::resource('', OrganizationController::class)->parameters(['' => 'organization']);
        });

        Route::prefix('member')->name('member.')->group(function () {
            Route::resource('', MemberController::class)->parameters(['' => 'member']);
        });
    });
});
