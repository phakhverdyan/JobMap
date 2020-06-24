<?php

namespace App\Http\Middleware;

use Closure;

class ForbiddenIfNotLoggedIn
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            abort(403);
        }

        return $next($request);
    }
}
