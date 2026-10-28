<?php

namespace App\Support;

class Localize
{
    public static function line(string $key, ?string $fallback): string
    {
        $fallback ??= '';

        if (! app('translator')->has($key, app()->getLocale(), false)) {
            return $fallback;
        }

        return __($key);
    }

    public static function rating(float|int|string|null $value): string
    {
        $decimal = app()->getLocale() === 'en' ? '.' : ',';

        return number_format((float) $value, 1, $decimal, ' ');
    }
}
