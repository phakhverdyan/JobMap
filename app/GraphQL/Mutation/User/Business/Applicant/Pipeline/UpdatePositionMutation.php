<?php

namespace App\GraphQL\Mutation\User\Business\Applicant\Pipeline;

use App\Business\Administrator;
use App\Business\Pipeline;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdatePositionMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'Update Pipeline items position'
    ];
    
    public function type()
    {
        return GraphQL::type('Pipeline');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'data' => ['required', 'string']
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Business id'
            ],
            'data' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Pipeline positions'
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
        /*$this->permissions = [
            'departments'
        ];*/
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();
        
        $positions = json_decode($args['data']);
        foreach ($positions as $k => $v) {
            Pipeline::where([
                'id' => $v,
                'business_id' => $args['business_id']
            ])->update([
                'position' => $k
            ]);
        }
        
        return [
            'items' => [],
            'token' => $this->token
        ];
    }
}
