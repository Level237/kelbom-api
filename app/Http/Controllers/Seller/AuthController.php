<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Show registration form
     */
    public function showRegister()
    {
        return view('seller.auth.register');
    }

    /**
     * Show login form
     */
    public function showLogin()
    {
        return view('seller.auth.login');
    }

    /**
     * Handle registration
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:100',
            'phone_number'   => 'required|string|max:20|unique:users',
            'password'       => ['required', 'confirmed', Password::min(8)],
        ]);

        // Créer l'utilisateur
        $user = User::create([
            'name'           => $validated['name'],
            'phone_number'   => $validated['phone_number'],
            'password'       => Hash::make($validated['password']),
        ]);

        // Assigner le rôle 'seller'
        $user->assignRole('seller');

        // Connexion automatique
        Auth::login($user);
        $request->session()->regenerate();

        // Rediriger vers la création de stand
        return redirect()->route('seller.stand.create');
    }

    /**
     * Smart redirect based on user status
     * Used by hero CTA button to route correctly
     */
    public function getAccessRoute()
    {
        // Si pas authentifié → /register
        if (!Auth::check()) {
            return redirect()->route('seller.register');
        }

        $user = Auth::user();

        // Si pas de stand → /stand/create
        if (!$user->stand()->exists()) {
            return redirect()->route('seller.stand.create');
        }

        // Si stand existe → /dashboard
        return redirect()->route('seller.dashboard');
    }
}

