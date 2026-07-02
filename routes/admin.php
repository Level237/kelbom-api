<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;

Route::domain(config('app.client_domain'))->group(function () {
    // Admin Routes (Hors du domaine client pour l'instant)


    Route::get('/admin-login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin-login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/admin-logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Espace Admin Protégé
    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        
        Route::patch('stands/{stand}/toggle-status', [\App\Http\Controllers\Admin\StandController::class, 'toggleStatus'])->name('stands.toggle-status');
        Route::resource('stands', \App\Http\Controllers\Admin\StandController::class);

        Route::patch('products/{product}/toggle-status', [\App\Http\Controllers\Admin\ProductController::class, 'toggleStatus'])->name('products.toggle-status');
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->only(['index', 'destroy']);
        
        Route::resource('requests', \App\Http\Controllers\Admin\RequestController::class)->only(['index', 'destroy'])->parameters(['requests' => 'client_request']);
    });

});