<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['stand.user', 'category'])->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function toggleStatus(Product $product)
    {
        // Si c'est actif, on désactive. Sinon on active.
        $newStatus = $product->status === 'active' ? 'inactive' : 'active';
        $product->update(['status' => $newStatus]);

        $message = $newStatus === 'active' ? 'activé' : 'désactivé';
        return back()->with('success', "Le produit a été $message avec succès.");
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Produit supprimé avec succès.');
    }
}
