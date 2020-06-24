<?php
/**
 * Created by PhpStorm.
 * User: denispetrusha
 * Date: 19.12.2017
 * Time: 16:04
 */

namespace App\GraphQL;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Business;
use App\Business\Administrator;

trait Auth
{
    public $auth;
    public $token;

    public function localize() {
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

        if (!$this->auth) {
            return false;
        }

        $this->localize();
        return true;
    }

    /*
    public function checkBusinessAccess($business_id, $roles = [], $permissions = [])
    {
        //--- TMP __del after
        $permissions = array_filter($permissions, function ($val) {
            return !in_array($val, ['buttons', 'chats', 'candidates', 'business']);
        });

        if (!$this->auth) {
            return false;
        }

        $business_administrator_query = \App\Business\Administrator::where([
            'user_id' => $this->auth->id,
            'business_id' => $business_id,
        ])->where(function($query) use ($roles) {
            $query->orWhere('role', \App\Business\Administrator::ADMIN_ROLE)
                ->orWhereIn('role', $roles);
        });

        // TODO - check & repair
        // if (count($permissions) > 0) {
        //     $business_administrator_query->whereHas('permits', function ($query) use ($permissions){
        //         $query->whereIn('slug', $permissions)
        //             ->where('value', 1);
        //     });
        // }

        if ($business_administrator_query->first()) {
            return true;
        }

        return false;
    }
    */

    //--- old

    public function checkBusinessAccess($businessID, $roles = [], $permissions = [])
    {
        if (!$businessID) {
            return false;
        }

        if ($this->checkIsAdmin($businessID)) {
            return true;
        }

        if ( $this->skipPermits($permissions) ) {
            return true;
        }

        $business_administrator_query = Administrator::where([
            'user_id' => $this->auth->id,
            'business_id' => $businessID,
        ])->where(function($query) use ($roles) {
            $query->orWhere('role', Administrator::ADMIN_ROLE);

            foreach ($roles as $role) {
                $query->orWhere('role', $role);
            }
        });

        $admin = $business_administrator_query->first();

        if ($admin && $permit = $admin->permits()->whereIn('slug', $permissions)->first()) {
            if ($permit->pivot->value == 1) {
                return true;
            }
            if ($permit->pivot_value == 1) {
                return true;
            }
        }

        return false;

        // throw new \Exception('Business administrator permission error.');
    }

    /**
     * Skip some permissions
     *
     * @param mix $permits
     * @return booblean
     */
    private function skipPermits($permits)
    {
        $permitsForSkip = [
            'buttons',
            'chats',
            'franchisees',
            'interviews_managers',
            'notes_managers',
            // 'candidates',
            // 'business'
        ];

        if (is_array($permits)) {
            return empty(array_diff($permits, $permitsForSkip));
        }

        if (is_string($permits)) {
            return in_array($permits, $permitsForSkip);
        }

        return false;
    }

    /**
     * Check admin permissions
     *
     * @param integer $businessId
     * @return booblean
     */
    public function checkIsAdmin(int $businessId)
    {
        if (!$this->auth) {
            return false;
        }

        $admin = $this->auth
                      ->_administratorBusiness($businessId)
                      ->first();

        if (! $admin) {
            return false;
        }

        if (optional($admin->business)->getKey() === $businessId) {
            return true;
        }

        return false;
    }


}
