<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('reviewable')->latest()->paginate(15);
        
        return view('admin.reviews.index', compact('reviews'));
    }

    public function toggleStatus(Review $review)
    {
        $review->update([
            'is_verified' => !$review->is_verified
        ]);

        $status = $review->is_verified ? 'approuvé' : 'désapprouvé';
        
        return back()->with('success', "Le commentaire a été {$status} avec succès.");
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', "Le commentaire a été supprimé avec succès.");
    }
}
