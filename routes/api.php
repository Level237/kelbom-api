<?php

use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\StandController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// VENDEUR
// ============================================================
Route::prefix('seller')->middleware(['auth:sanctum', 'role:seller'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'stats']);
    Route::get('/dashboard/leads-stats', [DashboardController::class, 'leadsStats']);
    Route::get('/dashboard/top-viewed', [DashboardController::class, 'topViewedProducts']);

    // Stand
    Route::get('/stand', [StandController::class, 'show']);
    Route::post('/stand', [StandController::class, 'store']);
    Route::put('/stand/{seller}', [StandController::class, 'update']);

    // Produits
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{product}', [ProductController::class, 'show']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
    Route::patch('/products/{product}/status', [ProductController::class, 'updateStatus']);
    Route::delete('/products/{product}/images/{imageId}', [ProductController::class, 'destroyImage']);

    // Leads disponibles (buy leads)
   
});
