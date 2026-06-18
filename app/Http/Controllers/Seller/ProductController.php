<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $stand = $request->user()->stand;

        if (!$stand) {
            return redirect()->route('seller.stand.create')->with('error', 'Créez d\'abord un stand');
        }

        $products = Product::where('stand_id', $stand->id)
            ->with(['category'])
            ->when($request->search, fn($q, $term) => $q->where('name', 'LIKE', "%{$term}%"))
            ->when($request->category_id, fn($q, $id) => $q->where('category_id', $id))
            ->when($request->status, fn($q, $status) => $q->where('status', $status))
            ->orderByDesc('updated_at')
            ->paginate(20);

        return view('seller.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all(); // On pourra filtrer plus tard si besoin
        return view('seller.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'compare_at_price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'min_order_quantity' => 'nullable|integer|min:1',
            'unit' => 'nullable|string|max:50',
            'status' => 'required|in:active,inactive,draft',
            'main_image' => 'nullable|image|max:5120',
            'images.*' => 'nullable|image|max:5120',
        ]);

        $stand = $request->user()->stand;

        $product = new Product();
        $product->stand_id = $stand->id;
        $product->name = $request->name;
        $product->slug = $product->generateSlug($request->name, $stand->id);
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->compare_at_price = $request->compare_at_price;
        $product->description = $request->description;
        $product->min_order_quantity = $request->min_order_quantity ?? 1;
        $product->unit = $request->unit;
        $product->status = $request->status;

        // Handle specifications if sent as array
        if ($request->has('specifications')) {
            $specs = collect($request->specifications)
                ->filter(fn($spec) => !empty($spec['key']) && !empty($spec['value']))
                ->values()
                ->toArray();
            $product->specifications = $specs;
        }

        if ($request->hasFile('main_image')) {

            $path = $request->file('main_image')->store('products/main', 'public');
            $product->main_image_url = $path;
        }

        $product->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $imageFile) {
                $path = $imageFile->store('products/gallery', 'public');
                $product->images()->create([
                    'image_url' => Storage::url($path),
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('seller.products.index')->with('success', 'Produit ajouté avec succès.');
    }

    public function edit(Product $product)
    {
        $this->authorizeOwner($product);
        $categories = Category::all();
        $product->load('images');
        return view('seller.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorizeOwner($product);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'compare_at_price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'min_order_quantity' => 'nullable|integer|min:1',
            'unit' => 'nullable|string|max:50',
            'status' => 'required|in:active,inactive,draft',
            'main_image' => 'nullable|image|max:5120',
            'images.*' => 'nullable|image|max:5120',
        ]);

        if ($request->name !== $product->name) {
            $product->slug = $product->generateSlug($request->name, $product->stand_id);
        }

        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->compare_at_price = $request->compare_at_price;
        $product->description = $request->description;
        $product->min_order_quantity = $request->min_order_quantity ?? 1;
        $product->unit = $request->unit;
        $product->status = $request->status;

        if ($request->has('specifications')) {
            $specs = collect($request->specifications)
                ->filter(fn($spec) => !empty($spec['key']) && !empty($spec['value']))
                ->values()
                ->toArray();
            $product->specifications = $specs;
        }

        if ($request->hasFile('main_image')) {
            // Delete old main image if exists
            if ($product->main_image_url) {
                $oldPath = str_replace('/storage/', '', $product->main_image_url);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('main_image')->store('products/main', 'public');
            $product->main_image_url = Storage::url($path);
        }

        $product->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store('products/gallery', 'public');
                $product->images()->create([
                    'image_url' => Storage::url($path),
                    'sort_order' => $product->images()->max('sort_order') + 1,
                ]);
            }
        }

        return redirect()->route('seller.products.index')->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Product $product)
    {
        $this->authorizeOwner($product);

        // Delete images from storage
        if ($product->main_image_url) {
            $path = str_replace('/storage/', '', $product->main_image_url);
            Storage::disk('public')->delete($path);
        }

        foreach ($product->images as $image) {
            $path = str_replace('/storage/', '', $image->image_url);
            Storage::disk('public')->delete($path);
        }

        $product->delete();

        return redirect()->route('seller.products.index')->with('success', 'Produit supprimé.');
    }

    private function authorizeOwner(Product $product)
    {
        $stand = auth()->user()->stand;
        if (!$stand || $product->stand_id !== $stand->id) {
            abort(403, 'Action non autorisée.');
        }
    }
}
