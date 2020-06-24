<?php

namespace App\Http\Middleware\Permit;

use App\Business\Administrator;
use App\GraphQL\Auth;
use Closure;

class CheckManagersEditSelf
{
    use Auth;

   /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->authorize([],[]);
        
        $businesses = $this->auth->businesses()->count();
        if ($businesses > 0)
        {
            $admin = Administrator::where('user_id', $this->auth->id)->where('role', 'admin')->first();
            if (!$admin)
            {
                return redirect('/business/candidate/manage');
            }
        }
        return $next($request);
    }
}
