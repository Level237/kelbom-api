<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stand;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques principales
        $visitorCount = 12450; // Valeur fictive ou issue d'un service d'analytics
        $standsCount = Stand::count();
        $productsCount = Product::count();

        // 8 derniers stands
        $latestStands = Stand::latest()->take(8)->get();
        
        // 8 derniers produits avec la relation stand pour éviter les requêtes N+1
        $latestProducts = Product::with('stand')->latest()->take(8)->get();

        return view('admin.dashboard.index', compact(
            'visitorCount',
            'standsCount',
            'productsCount',
            'latestStands',
            'latestProducts'
        ));
    }
}
