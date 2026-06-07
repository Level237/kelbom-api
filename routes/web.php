<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('seller.homepage');
});


Route::get('/seller/homepage', function () {
    return view('seller.homepage');
});

Route::get('create-stand',function(){
    return view('seller.create-stand');
});
