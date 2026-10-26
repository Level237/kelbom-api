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

        $categoryIds = Category::query()
            ->where('id', $category->id)
            ->orWhere('parent_id', $category->id)
            ->pluck('id');

        $stands = Stand::query()
            ->where('is_verified', true)
            ->where(function ($query) use ($categoryIds) {
                $query->whereHas('categories', function ($q) use ($categoryIds) {
                    $q->whereIn('categories.id', $categoryIds)
                        ->orWhereIn('categories.parent_id', $categoryIds);
                })->orWhereHas('products', function ($q) use ($categoryIds) {
                    $q->where('status', 'active')->whereIn('category_id', $categoryIds);
                });
            })
            ->latest()
            ->get();

        $products = Product::with('stand')
            ->whereIn('category_id', $categoryIds)
            ->where('status', 'active')
            ->latest()
            ->get();

        return view('client.category.show', compact('category', 'stands', 'products'));
    }
}
