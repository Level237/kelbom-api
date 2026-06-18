<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;


class LoadingStandController extends Controller
{
    public function index()
    {
        return view('seller.loading-stand', [
            'user' => auth()->user()
        ]);
    }
}
