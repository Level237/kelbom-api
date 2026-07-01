<?php


use App\Http\Controllers\Seller\AuthController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\HomepageController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\StandController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\MarketplaceController;
use App\Http\Controllers\Client\RequestController;
use App\Http\Controllers\Client\StandProfileController;

Route::domain(config('app.client_domain'))->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('client.home');
    Route::get('/marketplace', [MarketplaceController::class, 'index'])->name('client.marketplace');
    Route::get('/demande', [RequestController::class, 'create'])->name('client.request.create');
    Route::post('/demande', [RequestController::class, 'store'])->name('client.request.store');
    Route::get('/stand/{slug}', [StandProfileController::class, 'show'])->name('client.stand.show');
});

// Admin Routes (Hors du domaine client pour l'instant)
use App\Http\Controllers\Admin\AuthController as AdminAuthController;

Route::get('/admin-login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin-login', [AdminAuthController::class, 'login'])->name('admin.login.submit');