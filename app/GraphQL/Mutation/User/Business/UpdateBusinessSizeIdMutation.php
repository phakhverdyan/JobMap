<?php

namespace App\GraphQL\Mutation\User\Business;

use App\Business\Administrator;
use App\GraphQL\Auth;
use App\Business;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateBusinessSizeIdMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'Update Business'
    ];
    
    public function type()
    {
        return GraphQL::type('Business');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'id' => ['required'],
            'size_id' => ['required', 'min:1', 'max:9'],
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the business'
            ],
            'size_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Business size'
            ],
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args)
    {
        if (Business::find($args['id']) && Business::find($args['id'])->parent_id) {
            //set authorized roles
            $this->roles = [
                Administrator::MANAGER_ROLE,
                /*Administrator::BRANCH_ROLE,
                Administrator::FRANCHISE_ROLE*/
            ];
            //set permissions for this object
            $this->permissions = [
                'brands'
            ];
            //set business ID
            $this->businessID = $args['id'];
            //check permissions
            $this->check();
        }
        

        $data = Business::where([
            'id' => $args['id'],
        ])->update([
            'size_id' => $args['size_id'],
        ]);
        
        if (!$data) {
            return null;
        }
        
        return ['token' => $this->token];
    }
}
