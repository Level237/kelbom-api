<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Création de stand : accessible uniquement tant que le vendeur n'a pas encore de stand.
 */
class EnsureSellerOnboarding
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->stand()->exists()) {
            return redirect()->route('seller.dashboard');
        }

        return $next($request);
    }
}
