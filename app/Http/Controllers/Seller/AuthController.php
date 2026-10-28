<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
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
        ], $this->validationMessages(), $this->validationAttributes());

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Redirige vers là où il faut
            if (Auth::user()->stand && Auth::user()->stand->stand_name) {

                return redirect()->route('seller.dashboard');
            }

            return redirect()->route('seller.create');
        }

        return back()->withErrors([
            'phone_number' => __('seller.flash.invalid_credentials'),
        ])->onlyInput('phone_number');
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

    private function validationMessages(): array
    {
        $messages = trans('seller.validation.messages');

        return is_array($messages) ? $messages : [];
    }

    private function validationAttributes(): array
    {
        $attributes = trans('seller.validation.attributes');

        return is_array($attributes) ? $attributes : [];
    }

    /**
     * Smart redirect based on user status
     * Used by hero CTA button to route correctly
     */
    public function getAccessRoute()
    {
        if (! Auth::check()) {
            return redirect()->route('seller.create');
        }

        $user = Auth::user();

        // Si pas de stand → /stand/create
        if (!$user->stand()->exists()) {
            return redirect()->route('seller.create');
        }

        // Si stand existe → /dashboard
        return redirect()->route('seller.dashboard');
    }
}

