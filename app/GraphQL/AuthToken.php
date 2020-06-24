<?php
/**
 * Created by PhpStorm.
 * User: denispetrusha
 * Date: 19.12.2017
 * Time: 16:04
 */

namespace App\GraphQL;

use Tymon\JWTAuth\Facades\JWTAuth;

trait AuthToken
{
    public $credentials;
    public $token;
    
    public function getToken($user = null) {
        try {
            // attempt to verify the credentials and create a token for the user
            
            if ($user) {
                if (!$this->token = JWTAuth::fromUser($user)) {
                    return false;
                }

                return $this->token;
            }

            if (!$this->token = JWTAuth::attempt($this->credentials)) {
                return false;
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return false;
        }
        
        return $this->token;
    }
}
