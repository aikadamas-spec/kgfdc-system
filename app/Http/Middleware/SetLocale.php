<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Read the locale from the session and apply it to the app.
     * Falls back to APP_LOCALE (.env) → 'sw' if nothing is set.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Use the request session directly — guaranteed to be started at this point
        $locale = $request->session()->get('locale', config('app.locale', 'sw'));

        if (in_array($locale, ['en', 'sw'])) {
            App::setLocale($locale);
        } else {
            App::setLocale('sw');
        }

        return $next($request);
    }
}
