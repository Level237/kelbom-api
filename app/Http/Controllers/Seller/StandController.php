<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Resources\Stand\StandResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StandController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        $seller = $request->user()->seller;

        if (! $seller) {
            return response()->json([
                'message' => 'Vous n\'avez pas encore de stand. Créez-le.',
                'has_stand' => false,
            ], 200);
        }

        return response()->json([
            'has_stand' => true,
            'stand'     => new StandResource($seller->load('user', 'products', 'activeSubscription')),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->seller) {
            return response()->json(['message' => 'Vous avez déjà un stand.'], 409);
        }

        $validated = $request->validate([
            'stand_name'      => 'required|string|max:255',
            'description'     => 'nullable|string|max:5000',
            'city'            => 'required|string|max:100',
            'country'         => 'nullable|string|max:100',
            'contact_phone'   => 'nullable|string|max:20',
            'contact_email'   => 'nullable|email|max:255',
            'whatsapp_number' => 'nullable|string|max:20',
            'address'         => 'nullable|string|max:500',
            'latitude'        => 'nullable|numeric|between:-90,90',
            'longitude'       => 'nullable|numeric|between:-180,180',
        ]);

        $seller = $user->seller()->create([
            'stand_name'    => $validated['stand_name'],
            'slug'          => \Str::slug($validated['stand_name']) . '-' . $user->id,
            'description'   => $validated['description'] ?? null,
            'city'          => $validated['city'],
            'country'       => $validated['country'] ?? 'Togo',
            'contact_phone' => $validated['contact_phone'] ?? $user->phone_number,
            'contact_email' => $validated['contact_email'] ?? $user->email,
            'whatsapp_number' => $validated['whatsapp_number'] ?? null,
            'address'       => $validated['address'] ?? null,
            'latitude'      => $validated['latitude'] ?? null,
            'longitude'     => $validated['longitude'] ?? null,
        ]);

        // Créer le compte crédits
        $seller->buyleadCredits()->create([
            'available_credits' => 0,
        ]);

        return response()->json([
            'message' => 'Stand créé avec succès',
            'stand'   => new StandResource($seller->load('user')),
        ], 201);
    }

    public function update(Request $request): JsonResponse
    {
        $seller = $request->route('seller');

        $validated = $request->validated();

        // Régénérer le slug si le nom change
        if (isset($validated['stand_name']) && $validated['stand_name'] !== $seller->stand_name) {
            $validated['slug'] = $seller->generateSlug($validated['stand_name']);
        }

        $seller->update($validated);

        return response()->json([
            'message' => 'Stand mis à jour',
            'stand'   => new StandResource($seller->fresh()->load('user')),
        ]);
    }
}
