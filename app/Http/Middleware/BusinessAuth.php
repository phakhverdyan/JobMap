<?php

namespace App\Http\Middleware;

use App\Business;
use App\Business\Administrator;
use App\Business\BusinessBilling;
use Illuminate\Support\Facades\Cookie;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class BusinessAuth
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
        $token = JWTAuth::toUser($request->cookie('api-token'));

        if(!$token){
            header("Set-Cookie: api-token=; Domain=" . env('SESSION_DOMAIN') . "; EXPIRES 1;path=/");
            return redirect('/');
        }

        $businessID = false;

        if ($request->cookie('business-id')) {
            $businessID = $request->cookie('business-id');
        }
        elseif ($request->cookie('last-business-id')) {
            $businessID = $request->cookie('last-business-id');
            header("Set-Cookie: business-id=$businessID; Domain=" . env('SESSION_DOMAIN') . "; EXPIRES 129600;path=/");
            return redirect($request->url());
        }

        if ($businessID) {
            $query = Business::query();
            $query->join('business_administrators', 'business_administrators.business_id', '=', 'businesses.id');
            $query->where('business_administrators.user_id', '=', $token->id);
            $query->where('business_administrators.business_id', '=', $businessID);
            $data = $query->first();


            if (!$data) {
                return redirect('/user/dashboard');
            }

            $request->attributes->add(['auth_business_id' => $businessID]);
        }
        else {
            return redirect('/user/dashboard');
        }

        return $next($request);
    }
}
