<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Stand;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch 6 active parent categories with up to 3 active children each
        $parentCategories = Category::whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $homeStands = Stand::query()
            ->with(['categories', 'activeProducts.category'])
            ->orderByDesc('is_verified')
            ->orderByDesc('rating_avg')
            ->get()
            ->map(function (Stand $stand) {
                $logo = $stand->logo_url;
                $cover = $stand->cover_url;
                if ($logo && ! str_starts_with($logo, 'http')) {
                    $logo = Storage::url($logo);
                }
                if ($cover && ! str_starts_with($cover, 'http')) {
                    $cover = Storage::url($cover);
                }

                return [
                    'name' => $stand->stand_name,
                    'slug' => $stand->slug,
                    'city' => $stand->city,
                    'country' => $stand->country,
                    'description' => $stand->description,
                    'rating' => number_format((float) $stand->rating_avg, 1, ',', ' '),
                    'logo' => $logo,
                    'cover' => $cover,
                    'initial' => mb_strtoupper(mb_substr($stand->stand_name, 0, 1)),
                    'url' => route('client.stand.show', $stand->slug),
                    'category_ids' => $stand->categories
                        ->concat($stand->activeProducts->pluck('category')->filter())
                        ->flatMap(fn ($category) => array_values(array_filter([$category->id, $category->parent_id])))
                        ->unique()
                        ->values()
                        ->all(),
                ];
            })
            ->values();

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

        return view('client.homepage', compact('categories', 'parentCategories', 'premiumStands', 'homeStands'));
    }

    public function about()
    {
        return view('client.about');
    }
}
