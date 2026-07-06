<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stand;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Récupérer les stands de cette catégorie
        $stands = Stand::whereHas('categories', function($q) use ($category) {
            $q->where('categories.id', $category->id);
        })->where('is_verified', true)->latest()->get();

        // Récupérer les produits de cette catégorie
        $products = Product::with('stand')
            ->where('category_id', $category->id)
            ->where('status', 'active')
            ->latest()
            ->get();

        return view('client.category.show', compact('category', 'stands', 'products'));
    }
}
