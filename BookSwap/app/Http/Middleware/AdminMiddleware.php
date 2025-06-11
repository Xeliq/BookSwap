<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->rola === 'ADMIN') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Nie masz uprawnień do tej strony.');
    }
}
