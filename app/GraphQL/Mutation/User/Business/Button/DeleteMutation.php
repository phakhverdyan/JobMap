<?php

namespace App\GraphQL\Mutation\User\Business\Button;

use App\Business\Administrator;
use App\Business\WebsiteButton;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\WorldLanguage;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;


class DeleteMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'Delete Website Button'
    ];
    
    public function type()
    {
        return GraphQL::type('WebsiteButton');
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
                'description' => 'Button id'
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
        //set authorized roles
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::BRANCH_ROLE
        ];
        //set permissions for this object
        $this->permissions = [
            'buttons'
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();
        
        $button = WebsiteButton::where([
            'id' => $args['id'],
            'business_id' => $args['business_id']
        ]);
    
        if($button){
            if(!$button->delete()){
                return null;
            }
        }
    
        $data['token'] = $this->token;
    
        return $data;
    }
}
