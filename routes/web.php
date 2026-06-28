<?php


use App\Http\Controllers\Seller\AuthController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\HomepageController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\StandController;
use Illuminate\Support\Facades\Route;


Route::domain(config('app.client_domain'))->group(function () {
    Route::get('/', function () {
        return view("client.homepage");
    });



});