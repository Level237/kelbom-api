<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('seller.homepage');
});


Route::get('/seller/homepage', function () {
    return view('seller.homepage');
});
