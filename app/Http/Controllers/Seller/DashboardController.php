<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Resources\Stand\DashboardResource;
use App\Http\Resources\Stand\ProductResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

public function index()
    {
        return view('seller.dashboard');
    }
    public function stats(Request $request): JsonResponse
    {
        $seller = $request->user()->stand;

        if (! $seller) {
            return response()->json([
                'message'   => 'Créez d\'abord un stand',
                'has_stand' => false,
            ], 200);
        }

        $seller->load([
            'user',
            'products',
            'activeProducts',
            'buyleadCredits',
            'activeSubscription',
            'recentSellerLeads' => fn ($q) => $q->with('lead.category', 'lead.buyer')->latest()->limit(5),
            'topProducts' => fn ($q) => $q->active()->orderByDesc('inquiries_count')->limit(5),
        ]);

        return response()->json(new DashboardResource($seller));
    }

    /**
     * Produits les plus consultés
     */
    public function topViewedProducts(Request $request): JsonResponse
    {
        $seller = $request->user()->seller;

        if (! $seller) {
            return response()->json(['message' => 'Créez d\'abord un stand'], 403);
        }

        $products = $seller->products()
            ->active()
            ->orderByDesc('views_count')
            ->limit(10)
            ->get();

        return response()->json(ProductResource::collection($products));
    }
}
