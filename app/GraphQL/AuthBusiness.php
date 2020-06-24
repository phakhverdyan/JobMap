<?php
/**
 * Created by PhpStorm.
 * User: denispetrusha
 * Date: 11.01.2018
 * Time: 00:33
 */

namespace App\GraphQL;

use App\Business;
use App\Business\Administrator;
use GraphQL\Error\UserError;

trait AuthBusiness
{
    //authorized roles
    public $roles = [];
    //current business ID
    public $businessID;
    //permissions by role
    public $permissions = [];

    public function check()
    {
        if (!$business = Business::where('id', $this->businessID)->first()) {
            throw with(new UserError('No such business!'));
        }

        //--- TMP __del after

        // $this->permissions = array_filter($this->permissions, function ($val) {
        //     return !in_array($val, [ 'buttons', 'chats', 'candidates', 'business' ]);
        // });

        $administrator_query = Administrator::query();
        $administrator_query->where('user_id', $this->auth->id);

        if ($business->parent_id) { // if it is a brand then check main business as well
            $administrator_query->whereIn('business_id', [$business->id, $business->parent_id]);
        } else {
            $administrator_query->where('business_id', $business->id);
        }

        $administrator_query->where(function($where) {
            $where->orWhere('role', \App\Business\Administrator::ADMIN_ROLE);
            $where->orWhereIn('role', $this->roles);
        });

        // TODO - check & repair
        /*
        if (count($this->permissions) > 0) {
            $admin_query->whereHas('permits', function ($query) {
                $query->whereIn('slug', $this->permissions)
                    ->where('value', 1);
            });
        }
        */

        if ($administrator_query->first()) {
            return true;
        }

        throw with(new UserError('Permission error!'));
    }

    //--- old
    /*public function check()
    {
        $admin_query = Administrator::where([
            'user_id' => $this->auth->id,
            'business_id' => $this->businessID,
        ])->where(function($query) {
            $query->orWhere('role', Administrator::ADMIN_ROLE);

            foreach ($this->roles as $role) {
                $query->orWhere('role', $role);
            }
        });

        if (count($this->permissions) > 0) {
            $admin_query->join('business_administrator_permissions', 'business_administrator_permissions.administrator_id', '=', 'business_administrators.id');

            foreach ($this->permissions as $permission) {
                $admin_query->where('business_administrator_permissions.' . $permission, '=', 1);
            }
        }

        $admin = $admin_query->first();

        if ($admin) {
            //permission granted
            return true;
        } else {
            throw with(new UserError('Permission error!'));
        }
    }*/
}
