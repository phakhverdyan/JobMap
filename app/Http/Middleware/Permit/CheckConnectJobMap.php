<?php

namespace App\Http\Middleware\Permit;

use App\Business\Administrator;
use App\GraphQL\Auth;

class CheckConnectJobMap
{
    use Auth;

    public function handle($request, \Closure $next)
    {
        $businessId = $request->cookie('business-id');

        $this->authorize([],[]);
        if ($businessId) {
            if (!$this->checkBusinessAccess($businessId,[ Administrator::MANAGER_ROLE ], [ 'connect_jobmap' ])) {
                return redirect('/business/candidate/manage');
                //return redirect('/');
            }
        }

        return $next($request);
    }
}
