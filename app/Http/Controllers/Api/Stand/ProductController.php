<?php

namespace App\Http\Controllers\Api\Stand;

use App\Http\Controllers\Controller;
use App\Http\Resources\Stand\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $seller = $request->user()->seller;

        if (!$seller) {
            return response()->json(['message' => 'Créez d\'abord un stand'], 403);
        }

        $products = Product::where('seller_id', $seller->id)
            ->with(['category', 'images'])
            ->when($request->status, fn($q, $status) => $q->where('status', $status))
            ->when($request->search, fn($q, $term) => $q->where('name', 'LIKE', "%{$term}%"))
            ->when($request->category_id, fn($q, $id) => $q->where('category_id', $id))
            ->orderByDesc('updated_at')
            ->paginate($request->per_page ?? 20);

        return response()->json([
            'data' => ProductResource::collection($products->items()),
            'meta' => [
                'current_page' => $products->currentPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
                'last_page' => $products->lastPage(),
            ],
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $seller = $request->user()->seller;

        if (!$seller) {
            return response()->json(['message' => 'Créez d\'abord un stand'], 403);
        }

        $validated = $request->validated();

        $product = $seller->products()->create([
            'name' => $validated['name'],
            'slug' => (new Product)->generateSlug($validated['name'], $seller->id),
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'compare_at_price' => $validated['compare_at_price'] ?? null,
            'min_order_quantity' => $validated['min_order_quantity'] ?? 1,
            'unit' => $validated['unit'] ?? null,
            'specifications' => $validated['specifications'] ?? null,
            'main_image_url' => $validated['main_image_url'] ?? null,
            'status' => $validated['status'] ?? 'draft',
        ]);

        // Ajouter les images additionnelles
        if (!empty($validated['images'])) {
            $images = [];
            foreach ($validated['images'] as $i => $url) {
                $images[] = [
                    'image_url' => $url,
                    'sort_order' => $i,
                ];
            }
            $product->images()->createMany($images);
        }

        try {
            \Illuminate\Support\Facades\Mail::to('bramslevel129@gmail.com')->send(new \App\Mail\ProductCreatedMail($product->load('seller', 'category')));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erreur lors de l\'envoi de l\'email ProductCreatedMail : ' . $e->getMessage());
        }

        return response()->json([
            'message' => 'Produit créé avec succès',
            'product' => new ProductResource($product->load('category', 'images')),
        ], 201);
    }

    public function show(Request $request, Product $product): JsonResponse
    {
        // Vérifier que le produit appartient au vendeur
        if ($product->seller_id !== $request->user()->seller?->id) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $product->load(['category', 'images']);

        return response()->json([
            'product' => new ProductResource($product),
        ]);
    }

    public function update(Request $request, Product $product): JsonResponse
    {
        $validated = $request->validated();

        // Régénérer le slug si le nom change
        if (isset($validated['name']) && $validated['name'] !== $product->name) {
            $validated['slug'] = $product->generateSlug($validated['name'], $product->seller_id);
        }

        $product->update($validated);

        // Si des images sont fournies, les remplacer
        if ($request->has('images')) {
            $product->images()->delete();
            $images = [];
            foreach ($validated['images'] as $i => $url) {
                $images[] = [
                    'image_url' => $url,
                    'sort_order' => $i,
                ];
            }
            $product->images()->createMany($images);
        }

        return response()->json([
            'message' => 'Produit mis à jour',
            'product' => new ProductResource($product->fresh()->load('category', 'images')),
        ]);
    }

    public function destroy(Request $request, Product $product): JsonResponse
    {
        if ($product->seller_id !== $request->user()->seller?->id) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $product->delete();

        return response()->json([
            'message' => 'Produit supprimé',
        ]);
    }

    /**
     * Changer le statut d'un produit (activer/désactiver)
     */
    public function updateStatus(Request $request, Product $product): JsonResponse
    {
        if ($product->seller_id !== $request->user()->seller?->id) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $request->validate([
            'status' => 'required|in:active,inactive,draft',
        ]);

        $product->update(['status' => $request->status]);

        return response()->json([
            'message' => 'Statut du produit mis à jour',
            'product' => new ProductResource($product->fresh()),
        ]);
    }

    /**
     * Supprimer en dur les images d'un produit (avant upload S3)
     */
    public function destroyImage(Request $request, Product $product, int $imageId): JsonResponse
    {
        if ($product->seller_id !== $request->user()->seller?->id) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $image = $product->images()->where('id', $imageId)->first();

        if (!$image) {
            return response()->json(['message' => 'Image non trouvée'], 404);
        }

        // TODO : Supprimer le fichier sur S3/MinIO ici
        // Storage::disk('s3')->delete(parse_url($image->image_url, PHP_URL_PATH));

        $image->delete();

        return response()->json(['message' => 'Image supprimée']);
    }

}
