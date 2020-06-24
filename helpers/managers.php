<?php

/**
 * Get auth user locations
 * For admin - all business locations
 */
if (!function_exists('get_my_locations')){
    function get_my_locations($businessID)
    {
        $myLocations = [];

        $administrator = \App\Business\Administrator::where([
            'business_id' => $businessID,
            'user_id' => auth()->user()->id
        ])->first();

        if ($administrator['role'] != 'admin') {
            $myLocations = \App\Business\ManagerLocation::where([
                'administrator_id' => $administrator['id']
            ])->pluck('location_id')->toArray();
        }

        return $myLocations;
    }
}

/**
 * Get auth user locations
 * For admin - all business locations
 */
if (!function_exists('get_manager_role')){
    function get_manager_role($businessID, $userID = null)
    {
        $administrator = \App\Business\Administrator::where([
            'business_id' => $businessID,
            'user_id' => $userID ? $userID : auth()->user()->id
        ])->first();

        if (!$administrator) {
            return false;
        }

        return $administrator->role;
    }
}
