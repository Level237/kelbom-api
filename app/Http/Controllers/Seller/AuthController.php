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
     * Handle login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'phone_number' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Redirige vers là où il faut
            if (Auth::user()->stand && Auth::user()->stand->stand_name) {

                return redirect()->route('seller.dashboard');
            }

            return redirect()->route('seller.stand.create');
        }

        return back()->withErrors([
            'phone_number' => 'Identifiants incorrects.',
        ])->onlyInput('phone_number');
    }

    /**
     * Handle registration
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone_number' => 'required|string|max:20|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        // Créer l'utilisateur
        $user = User::create([
            'name' => $validated['name'],
            'phone_number' => $validated['phone_number'],
            'password' => Hash::make($validated['password']),
        ]);

        // Assigner le rôle 'seller'
        $user->assignRole('seller');


        // Connexion automatique
        Auth::login($user);
        //$request->session()->regenerate();
        session(['registered_seller_phone' => $validated['phone_number']]);

        // Stocker le numéro de téléphone en session pour le tunnel de création de stand



        // Rediriger vers la création de stand
        //dd(session('registered_seller_phone'));
        return to_route('seller.stand.create');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
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

