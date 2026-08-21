<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;

class SetLocale
{
    protected array $supported = ['pt', 'fr', 'en'];

    public function handle(Request $request, Closure $next)
    {
        $locale = $this->resolveLocale($request);

        App::setLocale($locale);
        Carbon::setLocale($locale);

        $request->attributes->set('currentLocale', $locale);

        $response = $next($request);

        return $response->withCookie(
            Cookie::forever('eureka_locale', $locale, 60 * 24 * 365, '/', null, false, false)
        );
    }

    protected function resolveLocale(Request $request): string
    {
        if ($query = $request->query('lang')) {
            if (in_array($query, $this->supported, true)) {
                $request->session()->put('eureka_locale', $query);
                return $query;
            }
        }

        if ($session = $request->session()->get('eureka_locale')) {
            if (in_array($session, $this->supported, true)) {
                return $session;
            }
        }

        if ($cookie = $request->cookie('eureka_locale')) {
            if (in_array($cookie, $this->supported, true)) {
                $request->session()->put('eureka_locale', $cookie);
                return $cookie;
            }
        }

        return config('app.locale', 'pt');
    }
}
