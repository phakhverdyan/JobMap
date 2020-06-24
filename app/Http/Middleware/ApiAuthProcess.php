<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class ApiAuthProcess
{
    public function handle($request, Closure $next)
    {
        $api_token = null;

        if ($request->input('api_token')) {
            $api_token = $request->input('api_token');
            $request_input = $request->input();
            unset($request_input['api_token']);
            $request->replace($request_input);
        } elseif ($request->header('Authorization')) {
            $authorization_header = $request->header('Authorization');
            $authorization_header = preg_split('/\s+/', $authorization_header);

            if (count($authorization_header) > 1 && $authorization_header[0] == 'Basic') {
                $api_token = $authorization_header[1];
            }
        }

        if ($api_token) {
            try {
                $api_token_string = base64_decode($api_token);
            } catch (\Exception $exception) {
                return $next($request);
            }

            $user_id = base_convert(explode('.', $api_token_string)[0], 36, 10);

            if (!$user = User::where('id', $user_id)->first()) {
                // print_r($api_token);
                // echo "\n";
                // print_r('USER_ID: ' . $user_id);
                // echo "\n";
                // die('AUTH.1');
                return $next($request);
            }

            if ($user->api_token != $api_token) {
                // die('AUTH.2');
                return $next($request);
            }

            auth()->setUser($user);
            
            return $next($request);
        }

        // die('AUTH.4');

        return $next($request);
    }
}
