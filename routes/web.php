<?php

use App\Http\Controllers\Seller\AuthController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\HomepageController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\StandController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('seller.homepage');
});

// Smart access route (used by hero button CTA)
Route::get('/access-route', [AuthController::class, 'getAccessRoute'])->name('seller.access-route');





// Public Routes

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('seller.register');
Route::post('/register', [AuthController::class, 'register'])->name('seller.register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth', 'seller.access'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('seller.dashboard');
    
    Route::prefix('products')->name('seller.products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('stand')->name('seller.stand.')->group(function () {
        Route::get('/edit', [StandController::class, 'edit'])->name('edit');
        Route::put('/', [StandController::class, 'update'])->name('update');
        Route::get('/preview', [StandController::class, 'show'])->name('preview');
    });

    Route::get('/loading', [\App\Http\Controllers\Seller\LoadingStandController::class, 'index'])->name('seller.loading-stand');
});


Route::get('/stand/create', [StandController::class, 'create'])->name('seller.stand.create');
Route::post('/stand/create', [StandController::class, 'storeStep'])->name('seller.stand.storeStep');


