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
    Route::get('/produits', [MarketplaceController::class, 'products'])->name('client.products');
    Route::get('/demande', [RequestController::class, 'create'])->name('client.request.create');
    Route::post('/demande', [RequestController::class, 'store'])->name('client.request.store');
    Route::get('/stand/{slug}', [StandProfileController::class, 'show'])->name('client.stand.show');
    Route::post('/stand/{slug}/reviews', [\App\Http\Controllers\Client\ReviewController::class, 'store'])->name('client.stand.review.store');
    
    Route::get('/categorie/{slug}', [\App\Http\Controllers\Client\CategoryController::class, 'show'])->name('client.category.show');

    Route::get('/contact', [\App\Http\Controllers\Client\ContactController::class, 'create'])->name('client.contact.create');
    Route::post('/contact', [\App\Http\Controllers\Client\ContactController::class, 'store'])->name('client.contact.store');

    Route::get('/notre-histoire', [HomeController::class, 'about'])->name('client.about');


});

