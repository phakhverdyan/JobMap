<?php
/**
 * Created by PhpStorm.
 * User: denispetrusha
 * Date: 28.12.2017
 * Time: 03:34
 */

namespace App\GraphQL\Fields\Business\Manager;

use App\Business\Administrator;
use App\Business\BusinessBilling;
use App\User;
use App\GraphQL\Auth;
use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Field;
use Illuminate\Support\Facades\Storage;

class HtmlField extends Field
{
    use Auth;

    protected $attributes = [
        'description' => 'Business Manager HTML Item'
    ];

    public function type()
    {
        return Type::string();
    }

    public function args()
    {
        return [];
    }

    protected function resolve($root, $args)
    {
        if (isset($root['id'])) {

            $isAdmin = false;
//            if (Administrator::where('business_id', $root['business_id'])->where('user_id', $this->auth->id)->where('role', Administrator::ADMIN_ROLE)->first()) {
//                $isAdmin = true;
//            }

            $UserManager = Administrator::where('business_id', $root['business_id'])->where('user_id', $this->auth->id)->first();

            $isAccess = false;
            $isAccessLocation = false;
            if($UserManager->role == Administrator::ADMIN_ROLE){
                $isAdmin = true;
                $isAccess = true;
                $isAccessLocation = true;
            }elseif ($UserManager->role == Administrator::MANAGER_ROLE){
                if($root['role'] == Administrator::MANAGER_ROLE || $root['role'] == Administrator::FRANCHISE_ROLE){
                    $isAccess = true;
                    $isAccessLocation = true;
                }
            }else{
                if($this->auth->id === $root['user_id']){
                    $isAccess = true;
                }
            }

            switch ($root['role']){
                case Administrator::ADMIN_ROLE:
                    $manager = trans('main.roles.admin');
                    $isAdmin = false;
                    break;
                case Administrator::MANAGER_ROLE:
                    $manager = trans('main.roles.manager');
                    break;
                case Administrator::FRANCHISE_ROLE:
                    $manager = trans('main.roles.franchisee');
                    $isAdmin = false;
                    break;
                default:
                    $manager = trans('main.roles.manager');
                    break;
            }

            $BusinessBilling = BusinessBilling::where('business_id', $root['business_id'])
                ->where('user_id', $root['user_id'])
                ->where("billing_type", "user")
                ->join("business_billing_plans as bbp", "business_billings.plan_id",'=','bbp.id')
                ->select('*')
                ->first();
            

            $_Admin = Administrator::where('user_id', $root['user_id'])->first();
            $created = new Carbon($_Admin->created_at);
            $trial_days = 30 - $created->diff(Carbon::now())->days;
            $days_left = 0;
            if($trial_days > 0){
                $days_left = $trial_days;
            }
            $view = View('business.manage.graphql.manager_item', [
                'args' => $root,
                'days_left' => $days_left,
                'billing' => $BusinessBilling,
                'auth_user_id' => $this->auth->id,
                'user_paid' => User::where('id', $BusinessBilling['user_paid_id'])->first(),
                'manager' => $manager,
                'isAdmin' => $isAdmin,
                'isAccessLocation' => $isAccessLocation,
                'isAccess' => $isAccess,
                'isCurrentUser' => $this->auth->id === $root['user_id']
            ])->render();

            return $view;
        }

        return '';
    }
}









