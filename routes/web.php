<?php

use App\Http\Controllers\Seller\AuthController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\StandController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('seller.homepage');
});

// Smart access route (used by hero button CTA)
Route::get('/access-route', [AuthController::class, 'getAccessRoute'])->name('seller.access-route');





    // Public Routes
    Route::view('/', 'seller.landing')->name('seller.landing');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('seller.register');
    Route::post('/register', [AuthController::class, 'register']);

    // Protected Routes
    Route::middleware(['auth', 'seller.access'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('seller.dashboard');
        Route::get('/stand/create', [StandController::class, 'create'])->name('seller.stand.create');
        // ...
    });

