<?php


use App\Http\Controllers\Seller\AuthController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\HomepageController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\StandController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Client\HomeController;

Route::domain(config('app.client_domain'))->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('client.home');



});