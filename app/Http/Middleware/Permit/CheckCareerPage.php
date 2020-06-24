<?php

namespace App\Http\Middleware\Permit;

use App\Business\Administrator;
use App\GraphQL\Auth;

class CheckCareerPage
{
    use Auth;

    public function handle($request, \Closure $next)
    {
        $businessId = $request->cookie('business-id');

        $this->authorize([],[]);
        if ($businessId) {
            if (!$this->checkBusinessAccess($businessId,[ Administrator::MANAGER_ROLE ], [ 'career_page' ])) {
                return redirect('/business/candidate/manage');
                //return redirect('/');
            }
        }

        return $next($request);
    }
}
