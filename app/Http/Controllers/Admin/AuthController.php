<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // Logique de connexion à implémenter plus tard
        return back()->with('error', 'La connexion admin n\'est pas encore configurée.');
    }
}
