<?php

namespace App\Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdminUser
{

    public function handle($request, Closure $next, $guard = 'adminUser')
    {

        if (!Auth::guard($guard)->check()) {
            return redirect('/nexus/login');
        }
        return $next($request);
    }
}