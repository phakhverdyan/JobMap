<?php
namespace App\Http\Middleware;

use App\Language;
use App\User;
use Closure;
use Exception;
use Illuminate\Support\Facades\App;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class GetRequestLanguage
{
    public function handle(Request $request, Closure $next) {

        if(!auth()->user() && $request->cookie('api-token')){
            try{
                $api_token = $request->cookie('api-token');
                $user  = JWTAuth::toUser($api_token);
                if ($user) {
                    auth()->onceUsingId($user->id);
                }
            }catch (Exception $e){
                $refreshed_token = JWTAuth::refresh(JWTAuth::getToken());
                $user = JWTAuth::toUser($refreshed_token);
                if ($user) {
                    auth()->onceUsingId($user->id);
                }
            }
        }

        if ($request->cookie('language')) {
            app()->setLocale($request->cookie('language'));
        } else {
            $available_locales = Language::pluck('prefix')->toArray();
            $user_agent_locales = explode(',', $request->server('HTTP_ACCEPT_LANGUAGE'));

            $user_agent_locales = array_unique(array_map(function ($current_user_agent_locale) {
                return explode('-', explode(';', $current_user_agent_locale)[0])[0];
            }, $user_agent_locales));

            $user_agent_locales = array_filter($user_agent_locales, function ($current_user_agent_locale) use ($available_locales) {
                return in_array($current_user_agent_locale, $available_locales);
            });

            $user_agent_locales = array_values($user_agent_locales);

            if (count($user_agent_locales) > 0) {
                app()->setLocale($user_agent_locales[0]);
                header("Set-Cookie: language=" . app()->getLocale() . "; EXPIRES 129600; Domain=" . env('SESSION_DOMAIN') . "; path=/");
            }
        }

        return $next($request);
    }
}
