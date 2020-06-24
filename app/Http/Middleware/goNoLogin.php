<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class goNoLogin
{
    
    public function handle($request, \Closure $next)
    {
        //dd($request->cookie());
        if ($request->cookie('api-token')) {
            return redirect('/');
        }

        return $next($request);
    }
}
