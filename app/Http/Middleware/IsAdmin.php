<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() && (Auth::user()->isAdmin() || Auth::user()->isManager())) {
            return $next($request);
        }

        return redirect('/login');

    }
}
