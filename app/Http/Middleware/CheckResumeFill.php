<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckResumeFill
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
        $user  = JWTAuth::toUser($request->cookie('api-token'));
//        if (!($user['preference']['is_complete'] === 1 && $user['availability']['is_complete'] === 1 && $user['basic']['is_complete'] === 1
//            && ($user['preference']['not_education'] || $user['education']->count() > 0) && ($user['preference']['first_job'] !== null || $user['experience']->count() > 0))
//            && !$user['attach_file']) {
//            return redirect('/user/resume/create');
//        } else {
//            return $next($request);
//        }
        if ( $user['resume_is_completed'] !== 1 ) {
            return redirect('/user/resume/create');
        } else {
            return $next($request);
        }
    }
}
