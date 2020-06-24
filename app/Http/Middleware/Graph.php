<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Graph
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->header('Language')) {
            App::setLocale($request->header('Language'));
        }
        return $next($request);
    }
}
