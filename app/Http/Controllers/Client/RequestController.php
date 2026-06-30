<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function create()
    {
        // Récupérer les catégories pour le formulaire
        $categories = Category::whereNull('parent_id')
            ->where('is_active', true)
            ->with(['children' => function($query) {
                $query->where('is_active', true);
            }])
            ->get();
            
        return view('client.request', compact('categories'));
    }

    public function store(Request $request)
    {
        // Logique de soumission à implémenter plus tard
        // Validation et enregistrement dans la base de données
        
        return back()->with('success', 'Votre demande a été soumise avec succès ! Les vendeurs vous contacteront très bientôt.');
    }
}
