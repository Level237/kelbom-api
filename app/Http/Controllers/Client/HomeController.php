<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch 6 active parent categories with up to 3 active children each
        $categories = Category::whereNull('parent_id')
            ->where('is_active', true)
            ->with([
                'children' => function ($query) {
                    $query->where('is_active', true)->take(3);
                }
            ])
            ->take(6)
            ->get();

        $premiumStands = \App\Models\Stand::where('is_verified', true)
            ->orderByDesc('rating_avg')
            ->take(8)
            ->get();

        return view('client.homepage', compact('categories', 'premiumStands'));
    }

    public function about()
    {
        return view('client.about');
    }
}
