<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Espace vendeur post-onboarding : redirige vers la création de stand si absent.
 */
class EnsureSellerHasStand
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if (! $user->stand()->exists()) {
            return redirect()
                ->route('seller.create')
                ->with('info', 'Terminez l\'ouverture de votre stand pour accéder à cette page.');
        }

        return $next($request);
    }
}
