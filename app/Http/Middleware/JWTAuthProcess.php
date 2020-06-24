<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Middleware\BaseMiddleware;

class JWTAuthProcess
{
    public function handle($request, \Closure $next)
    {
        if ($request->cookie('api-token')) {
            $token = $request->cookie('api-token');

            try {
                JWTAuth::authenticate(JWTAuth::getToken());
                $user = JWTAuth::toUser(JWTAuth::getToken());

                if ($user['lang']['prefix']) {
                    header("Set-Cookie: language=" . $user['lang']['prefix'] . "; EXPIRES 129600; Domain=" . env('SESSION_DOMAIN') . "; path=/");
                    App::setLocale($user['lang']['prefix']);
                }

                auth()->onceUsingId($user->id);
                
                return $next($request);
            } catch (JWTException $e) {
                try {
                    $refreshed_token = JWTAuth::refresh(JWTAuth::getToken());
                    $user = JWTAuth::toUser($refreshed_token);

                    if ($user['lang']['prefix']){
                        App::setLocale($user['lang']['prefix']);
                    }

                    if ($user['verification_date']) {
                        $datediff = time() - $user['verification_date']->timestamp;
                        $datediff = $datediff / (60*60);

                        if ($datediff > 24) {
                            // return redirect()->route('user.not_work');
                        }
                    }

                    header("Set-Cookie: api-token=" . $refreshed_token . "; Domain=" . env('SESSION_DOMAIN') . "; EXPIRES 129600;path=/");
                    auth()->onceUsingId($user->id);

                    return $next($request);
                } catch (\Exception $e) {}
            }
        }

        return $next($request);
    }
}
