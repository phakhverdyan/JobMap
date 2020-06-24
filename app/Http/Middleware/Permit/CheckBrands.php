<?php

namespace App\Http\Middleware\Permit;

use App\Business\Administrator;
use App\GraphQL\Auth;

class CheckBrands
{
    use Auth;

    public function handle($request, \Closure $next)
    {
        $businessId = $request->cookie('business-id');

        $requestId = $request->id;
        if ($requestId) {
            $this->authorize([],[]);
            if ($businessId) {
                if (!$this->checkBusinessAccess($businessId,[ Administrator::MANAGER_ROLE ], [ 'brands' ])) {
                    return redirect('/business/candidate/manage');
                    //return redirect('/');
                }
            }
        }

        return $next($request);
    }
}
