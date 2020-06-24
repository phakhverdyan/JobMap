<?php

namespace App\Http\Middleware\Permit;

use App\Business\Administrator;
use App\Business\Location;
use App\GraphQL\Auth;

class CheckLocations
{
    use Auth;

    public function handle($request, \Closure $next)
    {
        $businessId = $request->cookie('business-id');
        $this->authorize([],[]);

        $locationId = $request->id;
        if ($locationId && $location=Location::find($locationId)) {
            $businessId = $location->business_id;
        }

        if ($businessId) {

            if (!$this->checkBusinessAccess($businessId,[ Administrator::MANAGER_ROLE, Administrator::FRANCHISE_ROLE ], [ 'locations' ])) {
                return redirect('/business/candidate/manage');
                //return redirect('/');
            }
        }

        return $next($request);
    }
}
