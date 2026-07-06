<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StandProfileController extends Controller
{
    public function show($slug)
    {
        $stand = \App\Models\Stand::with(['reviews' => function($query) {
            $query->latest();
        }])->where('slug', $slug)->first();

        return view('client.stand-profile', compact('stand', 'slug'));
    }
}
