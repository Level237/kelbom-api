<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // L'utilisateur doit être authentifié (middleware 'auth' est appliqué avant)
        $user = $request->user();
        
        if (!$user) {
            return redirect()->route('seller.register');
        }

        // Vérifier si le vendeur a un stand
        $hasStand = $user->stand()->exists();

        // Si pas de stand → /stand/create
        if (!$hasStand) {
            return redirect()->route('seller.stand.create');
        }

        // Si stand existe → continuer vers /dashboard
        return $next($request);
    }
}

