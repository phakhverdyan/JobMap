<?php

namespace App\Http\Middleware\Permit;

use App\Business\Administrator;
use App\GraphQL\Auth;

class CheckIsBusinessAdmin
{
    use Auth;

    public function handle($request, \Closure $next)
    {
        if (is_admin()) {
            return $next($request);
        }

        return redirect('/business/candidate/manage');
    }
}
