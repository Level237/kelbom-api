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
            $selected = array_values(array_filter(array_map('intval', (array) $request->input('categories'))));
            $query->where(function ($outer) use ($selected) {
                $outer->whereHas('categories', function ($q) use ($selected) {
                    $q->whereIn('categories.id', $selected)
                        ->orWhereIn('categories.parent_id', $selected);
                })->orWhereHas('products', function ($q) use ($selected) {
                    $q->where('status', 'active')->whereHas('category', function ($category) use ($selected) {
                        $category->whereIn('categories.id', $selected)
                            ->orWhereIn('categories.parent_id', $selected);
                    });
                });
            });
        }

        if ($request->filled('rating')) {
            $query->where('rating_avg', '>=', $request->rating);
        }

        $stands = $query->latest()->paginate(16)->withQueryString();
        $categories = \App\Models\Category::whereNull('parent_id')->orderBy('name')->get();

        return view('client.marketplace', compact('stands', 'categories'));
    }

    public function products(Request $request)
    {
        $query = \App\Models\Product::with(['category', 'stand'])->where('status', 'active');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('categories')) {
            $selected = array_values(array_filter(array_map('intval', (array) $request->input('categories'))));
            $query->whereHas('category', function ($category) use ($selected) {
                $category->whereIn('categories.id', $selected)
                    ->orWhereIn('categories.parent_id', $selected);
            });
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->latest()->paginate(16)->withQueryString();
        $categories = \App\Models\Category::whereNull('parent_id')->orderBy('name')->get();

        return view('client.products', compact('products', 'categories'));
    }

    public function nearby(Request $request)
    {
        $lat = $request->filled('lat') ? (float) $request->input('lat') : null;
        $lon = $request->filled('lon') ? (float) $request->input('lon') : null;
        $hasLocation = $lat !== null && $lon !== null
            && $lat >= -90 && $lat <= 90
            && $lon >= -180 && $lon <= 180;

        $stands = \App\Models\Stand::query()
            ->with('categories')
            ->get()
            ->map(function ($stand) use ($hasLocation, $lat, $lon) {
                [$standLat, $standLon] = $this->standCoordinates($stand);
                $stand->distance_km = ($hasLocation && $standLat !== null && $standLon !== null)
                    ? $this->distanceKm($lat, $lon, $standLat, $standLon)
                    : null;

                return $stand;
            })
            ->sortBy(fn ($stand) => $stand->distance_km ?? INF)
            ->values();

        return view('client.nearby', [
            'stands' => $stands,
            'hasLocation' => $hasLocation,
        ]);
    }

    /**
     * @return array{0: ?float, 1: ?float}
     */
    private function standCoordinates(\App\Models\Stand $stand): array
    {
        if ($stand->latitude !== null && $stand->longitude !== null) {
            return [(float) $stand->latitude, (float) $stand->longitude];
        }

        $cities = [
            'douala' => [4.0511, 9.7679],
            'yaounde' => [3.8480, 11.5021],
            'yaoundé' => [3.8480, 11.5021],
            'bafoussam' => [5.4778, 10.4176],
            'garoua' => [9.3014, 13.3937],
            'bamenda' => [5.9597, 10.1457],
            'kribi' => [2.9404, 9.9100],
            'limbe' => [4.0186, 9.2064],
            'buea' => [4.1559, 9.2410],
            'lome' => [6.1725, 1.2314],
            'lomé' => [6.1725, 1.2314],
            'abidjan' => [5.3600, -4.0083],
            'dakar' => [14.7167, -17.4677],
            'cotonou' => [6.3703, 2.3912],
        ];

        $key = mb_strtolower(trim((string) $stand->city));

        return $cities[$key] ?? [null, null];
    }

    private function distanceKm(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earth = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) ** 2
            + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) ** 2;

        return $earth * 2 * atan2(sqrt($a), sqrt(1 - $a));
    }
}
