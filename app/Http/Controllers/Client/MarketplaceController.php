<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Stand::with(['categories'])->where('is_verified', true);

        if ($request->filled('search')) {
            $query->where('stand_name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('categories')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->whereIn('categories.id', $request->categories);
            });
        }

        if ($request->filled('rating')) {
            $query->where('rating_avg', '>=', $request->rating);
        }

        $stands = $query->latest()->paginate(16)->withQueryString();
        $categories = \App\Models\Category::whereNull('parent_id')->orderBy('name')->get();

        return view('client.marketplace', compact('stands', 'categories'));
    }
}
