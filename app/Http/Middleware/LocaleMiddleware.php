<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if ($user = Auth::user()) {
            App::setLocale(Str::before($user->locale, '_'));
        } elseif (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else {
            $preferredLanguage = $request->getPreferredLanguage(array_values(config('app.available_locales')));
            App::setLocale($preferredLanguage);
            Session::put('locale', $preferredLanguage);
        }

        return $next($request);
    }
}
