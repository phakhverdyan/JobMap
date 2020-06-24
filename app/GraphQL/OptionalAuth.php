<?php

namespace App\GraphQL;

use Tymon\JWTAuth\Facades\JWTAuth;

trait OptionalAuth
{
    public $auth;
    public $token;

    public function localize($root, $args) {
        if (isset($args['locale']) && $args['locale'] && in_array($args['locale'], config('graphql.available_locales'))) {
            \App::setLocale($args['locale']);
        }
        elseif ($this->auth && in_array($this->auth->language_prefix, config('graphql.available_locales'))) {
            \App::setLocale($this->auth->language_prefix);
        }
        else {
            $preferred_languages = array_values(array_unique(array_reduce(
                explode(',', \Request::server('HTTP_ACCEPT_LANGUAGE')),

                function($array, $string) {
                    $array[] = explode('-', explode(';q=', $string)[0])[0];
                    return $array;
                },

                []
            )));

            foreach ($preferred_languages as $preferred_language) {
                if (!in_array($preferred_language, config('graphql.available_locales'))) {
                    continue;
                }

                \App::setLocale($preferred_language);
                break;
            }
        }
    }
    
    public function authorize($root, $args)
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        }
        catch (\Exception $exception) {
            try {
                $refreshed = JWTAuth::refresh(JWTAuth::getToken());
                $this->token = $refreshed;
                $this->auth = JWTAuth::setToken($refreshed)->toUser();
            }
            catch (\Exception $exception) {
                $this->auth = null;
            }
        }
        
        $this->localize($root, $args);
        return true; // ALWAYS returns TRUE because we need just an optional auth
    }
}
