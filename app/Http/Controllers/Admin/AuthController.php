<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();
            // On vérifie que l'utilisateur a le rôle admin
            if ($user->hasRole('admin')) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }
            
            // Sinon on le déconnecte
            Auth::logout();
            return back()->withErrors([
                'email' => 'Accès refusé. Vous n\'avez pas les droits d\'administration.',
            ])->onlyInput('email');
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis sont incorrects.',
        ])->onlyInput('email');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login');
    }
}
