<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $supported = array_keys(config('locales.supported', []));
        $locale = (string) $request->session()->get('locale', 'fr');

        if (! in_array($locale, $supported, true)) {
            $locale = 'fr';
        }

        App::setLocale($locale);
        Carbon::setLocale($locale);

        return $next($request);
    }
}
