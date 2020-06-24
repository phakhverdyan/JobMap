<?php

namespace App\GraphQL\Mutation\User\Business\Department;

use App\Business\Administrator;
use App\Business\Department;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'Delete Business Department'
    ];
    
    public function type()
    {
        return GraphQL::type('BusinessDepartment');
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
        //set authorized roles
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::FRANCHISE_ROLE
        ];
        //set permissions for this object
        $this->permissions = [
            'departments'
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();
        
        $location = Department::where([
            'id' => $args['id'],
            'business_id' => $args['business_id']
        ]);
    
        if($location){
            if(!$location->delete()){
                return null;
            }
        }
    
        $data['token'] = $this->token;
    
        return $data;
    }
}
