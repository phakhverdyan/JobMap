<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;

class RedirectJWTAuth
{

    public function handle($request, \Closure $next)
    {
        $apiToken = $request->cookie('api-token');
        if (!$apiToken) {
            return redirect('/');
        }

        try {

            $user = JWTAuth::authenticate($request->cookie('api-token'));
            //$user = JWTAuth::authenticate(JWTAuth::getToken());
            //$user = JWTAuth::toUser(JWTAuth::getToken());

            if ($user->language) {
                header("Set-Cookie: language=" . $user->language->prefix . "; EXPIRES 129600; Domain=" . env('SESSION_DOMAIN') . "; path=/");
                App::setLocale($user->language->prefix);
            }

            if ($user['verification_date']) {
                $datediff = time() - $user['verification_date']->timestamp;
                $datediff = $datediff / (60 * 60);

                if ($datediff > 24) {
                    // return redirect()->route('user.not_work');
                }
            }

            if (!$user['country']) {
                return redirect()->route('user.signup');
            }
        }
        catch (\Exception $e) {

            try {
                $refreshed = JWTAuth::refresh(JWTAuth::getToken());

                JWTAuth::setToken($refreshed);

                $user = JWTAuth::authenticate();

                if ($user->language){
                    App::setLocale($user->language->prefix);
                }

                if ($user['verification_date']) {
                    $datediff = time() - $user['verification_date']->timestamp;
                    $datediff = $datediff / (60 * 60);

                    if ($datediff > 24) {
                        // return redirect()->route('user.not_work');
                    }
                }

                if (!$user['country']) {
                    return redirect()->route('user.signup');
                }

                setcookie('api-token', $refreshed, time()+129600, '/', env('SESSION_DOMAIN'));

                return redirect($request->url());
            }
            catch (\Exception $e) {

                header("Set-Cookie: api-token=;Domain=" . env('SESSION_DOMAIN') . ";EXPIRES 1;path=/");
                return redirect('/');
            }
        }

        return $next($request);
    }
}
