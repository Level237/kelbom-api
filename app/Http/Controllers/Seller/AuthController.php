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
    public function register(Request $request)
    {
        // MÊME validation, MÊME logique
        $validated = $request->validate([
            'name'   => 'required|string|max:100',
            'phone_number' => 'required|string|max:20|unique:users',
            'password'     => ['required', 'confirmed', Password::min(8)],
        ]);

        // MÊME création
        $user = User::create([
            'name'   => $validated['first_name'],
            'last_name'    => '',
            'phone_number' => $validated['phone_number'],
            'password'     => Hash::make($validated['password']),
        ]);

        $user->assignRole('seller');

        // Session web (pas de token)
        Auth::login($user);
        $request->session()->regenerate();

        // RETOURNE UNE REDIRECTION, PAS DU JSON
        return redirect()->route('seller.stand.create');
    }
}
