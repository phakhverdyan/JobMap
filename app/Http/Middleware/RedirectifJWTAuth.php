<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Middleware\BaseMiddleware;

class RedirectifJWTAuth
{

    public function handle($request, \Closure $next)
    {
        if ($request->cookie('api-token')) {
            $token = $request->cookie('api-token');
            try {
                JWTAuth::authenticate(JWTAuth::getToken());
                $user = JWTAuth::toUser(JWTAuth::getToken());
                if($user['lang']['prefix']){
                    header("Set-Cookie: language=" . $user['lang']['prefix'] . "; EXPIRES 129600; Domain=" . env('SESSION_DOMAIN') . "; path=/");
                    App::setLocale($user['lang']['prefix']);
                }
                if ($user['verification_date']) {
                    $datediff = time() - $user['verification_date']->timestamp;
                    $datediff = $datediff / (60*60);
                    if ($datediff > 24) {
                        // return redirect()->route('user.not_work');
                    }
                }
                if (!($user['preference']['is_complete'] === 1 && $user['availability']['is_complete'] === 1 && $user['basic']['is_complete'] === 1
                        && ($user['preference']['not_education'] || $user['education']->count() > 0) && ($user['preference']['first_job'] !== null || $user['experience']->count() > 0))
                    && !$user['attach_file']) {
                    $redirect = '/user/resume/create';
                } else {
                    $redirect = '/user/dashboard';
                }
                if ($request->cookie('seeker-mode')) {
                    return redirect($redirect);
                } else if ($request->cookie('business-id') || $request->cookie('last-business-id')) {
                    return redirect('/business/dashboard');
                } else {
                    return redirect($redirect);
                }
            } catch (JWTException $e) {
                try {
                    $refreshed = JWTAuth::refresh(JWTAuth::getToken());
                    $user = JWTAuth::toUser($refreshed);
                    if($user['lang']['prefix']){
                        App::setLocale($user['lang']['prefix']);
                    }
                    if ($user['verification_date']) {
                        $datediff = time() - $user['verification_date']->timestamp;
                        $datediff = $datediff / (60*60);
                        if ($datediff > 24) {
                            // return redirect()->route('user.not_work');
                        }
                    }
                    if (!($user['preference']['is_complete'] === 1 && $user['availability']['is_complete'] === 1 && $user['basic']['is_complete'] === 1
                            && ($user['preference']['not_education'] || $user['education']->count() > 0) && ($user['preference']['first_job'] !== null || $user['experience']->count() > 0))
                        && !$user['attach_file']) {
                        $redirect = '/user/resume/create';
                    } else {
                        $redirect = '/user/dashboard';
                    }
                    header("Set-Cookie: api-token=" . $refreshed . "; Domain=" . env('SESSION_DOMAIN') . "; EXPIRES 129600;path=/");
                    if ($request->cookie('seeker-mode')) {
                        return redirect($redirect);
                    } else if ($request->cookie('business-id') || $request->cookie('last-business-id')) {
                        return redirect('/business/dashboard');
                    } else {
                        return redirect($redirect);
                    }
                } catch (\Exception $e) {
                    header("Set-Cookie: api-token=; Domain=" . env('SESSION_DOMAIN') . "; EXPIRES 1;path=/");
                    return redirect('/');
                }
            }
        }
        return $next($request);
    }
}
