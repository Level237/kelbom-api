<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Stand;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $slug)
    {
        $stand = Stand::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'reviewer_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $stand->reviews()->create([
            'reviewer_name' => $validated['reviewer_name'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_verified' => false, // par défaut non vérifié
        ]);

        $stand->recalculateRating();

        return redirect()->route('client.stand.show', $stand->slug)
            ->with('success', 'Votre avis a été ajouté avec succès !');
    }
}
