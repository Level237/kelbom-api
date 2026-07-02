<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as HttpRequest;
use App\Models\Request as ClientRequest;
use App\Models\Category;

class RequestController extends Controller
{
    public function create()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('client.request', compact('categories'));
    }

    public function store(HttpRequest $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'budget' => 'nullable|integer|min:0',
            'reference_image' => 'nullable|image|max:5120', // max 5MB
            'urgency' => 'required|in:low,medium,high',
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
        ]);

        if ($request->hasFile('reference_image')) {
            $validated['reference_image'] = $request->file('reference_image')->store('requests', 'public');
        }

        ClientRequest::create($validated);

        return redirect()->back()->with('success', 'Votre demande a été soumise avec succès ! Nos vendeurs vous contacteront très bientôt.');
    }
}
