<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StandProfileController extends Controller
{
    public function show($slug)
    {
        // Simulation des données du Stand basées sur la structure de la table `stands`
        $stand = (object)[
            'stand_name' => 'Tech Universe Store',
            'slug' => $slug,
            'description' => 'La référence en matière de gadgets électroniques, smartphones de dernière génération et accessoires informatiques. Nous proposons des produits de haute qualité avec une garantie constructeur. Notre mission est de démocratiser l\'accès aux nouvelles technologies avec un service client irréprochable.',
            'logo_url' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=300&auto=format&fit=crop',
            'cover_url' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=1600&auto=format&fit=crop',
            'website_url' => 'https://tech-universe.com',
            'whatsapp_number' => '+228 90 00 00 00',
            'contact_email' => 'contact@techuniverse.com',
            'contact_phone' => '+228 22 00 00 00',
            'is_verified' => true,
            'rating_avg' => 4.9,
            'total_reviews' => 128,
            'address' => 'Avenue de la Libération, Quartier Administratif',
            'city' => 'Lomé',
            'country' => 'Togo',
            'created_at' => now()->subYears(2),
        ];

        return view('client.stand-profile', compact('stand'));
    }
}
