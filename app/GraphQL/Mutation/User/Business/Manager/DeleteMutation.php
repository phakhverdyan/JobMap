<?php

namespace App\GraphQL\Mutation\User\Business\Manager;

use App\Business\Administrator;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\Mail\UserNotifications;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Error\UserError;
use Illuminate\Support\Facades\Mail;

class DeleteMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'Delete Business Manager'
    ];
    
    public function type()
    {
        return GraphQL::type('BusinessManager');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Department id'
            ],
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Business id'
            ]
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args)
    {
        $administrator = Administrator::where([
            'id' => $args['id'],
            'business_id' => $args['business_id']
        ])->first();

        //set authorized roles
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::FRANCHISE_ROLE,
        ];
        //set permissions for this object
        $this->permissions = [
            $administrator->role . 's'
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();

        $business = \App\Business::where('id', $args['business_id'])->first();
        
        if ($administrator['user_id'] == $this->auth->id) {
            throw with(new UserError('Permission error!'));
        }
        
        if ($administrator) {
            if ($administrator['user']) {
                // Mail::to($administrator['user']['email'])->queue(new UserNotifications($administrator['user'], 'REMOVE_FROM_BUSINESS', [
                //     'business_id' => $args['business_id']
                // ]));

                Mail::to($administrator->user->email)->queue(new \App\Mail\ManagerDeleted($administrator->user, $business, 'INITIAL', $this->auth->language_prefix));
            }

            $administrator->delete();
        }
        
        $data['token'] = $this->token;
        return $data;
    }
}
