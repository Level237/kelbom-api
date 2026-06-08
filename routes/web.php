<?php

use App\Http\Controllers\Seller\AuthController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\StandController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('seller.homepage');
});


Route::get('create-stand',function(){
    return view('seller.create-stand');
});

Route::domain('seller.kelbom.com')->group(function () {

    // Public
    Route::view('/', 'seller.landing')->name('seller.landing');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('seller.register');
    Route::post('/register', [AuthController::class, 'register']);     // ← vue         // ← vue

    // Protégé
    Route::middleware(['auth', 'seller.access'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('seller.dashboard');
        Route::get('/stand/create', [StandController::class, 'create'])->name('seller.stand.create');
        // ...
    });
});
