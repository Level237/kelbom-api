<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:100',
            'phone_number' => 'required|string|max:20|unique:users',
            'password'     => ['required', 'confirmed', Password::min(8)],
            'role'         => 'required|in:buyer,seller,delivery_person',
        ]);

        $user = \App\Models\User::create([
            'name'   => $validated['first_name'],
            'last_name'    => $validated['last_name'],
            'phone_number' => $validated['phone_number'],
            'email'        => $validated['email'] ?? null,
            'password'     => Hash::make($validated['password']),
        ]);

        // Assigne le rôle via Spatie
        $user->assignRole($validated['role']);

        // Si c'est un vendeur, crée le profil vendeur vide
        if ($validated['role'] === 'seller') {
            $user->seller()->create([
                'stand_name' => $validated['first_name'] . ' ' . $validated['last_name'],
                'slug'       => \Str::slug($validated['first_name'] . '-' . $validated['last_name']) . '-' . $user->id,
                'city'       => 'Lomé',
            ]);

            // Crée le compte crédits
            $user->seller->buyleadCredits()->create([
                'available_credits' => 0,
            ]);
        }

        // Si c'est un livreur, crée le profil livreur vide
        if ($validated['role'] === 'delivery_person') {
            $user->deliveryPerson()->create([
                'slug' => \Str::slug($validated['first_name'] . '-' . $validated['last_name']) . '-' . $user->id,
            ]);
        }

        // Session + Token (même logique que login)
        $request->session()->regenerate();
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'user'  => new UserResource($user),
            'token' => $token,
            'roles' => $user->getRoleNames(),
        ], 201);
    }
}
