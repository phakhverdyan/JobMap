<?php

namespace App\Http\Middleware\Permit;

use App\Business\Administrator;
use App\GraphQL\Auth;

class CheckManagers
{
    use Auth;

    public function handle($request, \Closure $next)
    {
        $businessId = $request->cookie('business-id');
        $this->authorize([],[]);

        $adminId = $request->id;
        if ($adminId && $admin=Administrator::find($adminId)) {
            $businessId = $admin->business_id;
        }

        if ($businessId) {

            if (!$this->checkBusinessAccess($businessId,[ Administrator::MANAGER_ROLE ], [ 'managers' ])) {
                return redirect('/business/candidate/manage');
                //return redirect('/');
            }
        }

        return $next($request);
    }
}
