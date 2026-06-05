<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'phone_number' => 'required|string|max:20',
            'password'      => 'required|string',
        ]);

        $user = \App\Models\User::where('phone_number', $request->phone_number)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'phone_number' => ['Identifiants incorrects'],
            ]);
        }

        if (! $user->is_active) {
            throw ValidationException::withMessages([
                'phone_number' => ['Compte désactivé. Contactez le support.'],
            ]);
        }

        // Régénère la session (cookie auth pour le SPA web)
        $request->session()->regenerate();

        // Crée un token (token auth pour le mobile)
        $token = $user->createToken('auth-token')->plainTextToken;

        // Met à jour last_login_at
        $user->update(['last_login_at' => now()]);

        return response()->json([
            'user'  => new UserResource($user),
            'token' => $token,
            'roles' => $user->getRoleNames(),
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        // Révoque le token (mobile)
        $request->user()->currentAccessToken()->delete();

        // Invalide la session (web)
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Déconnecté avec succès']);
    }
}
