<?php

namespace App\GraphQL\Mutation\User\Business\Applicant\Pipeline;

use App\Business\Administrator;
use App\Business\Pipeline;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'Update Pipeline item'
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
                'description' => 'Pipeline id'
            ],
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Business id'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Pipeline name En'
            ],
            'name_fr' => [
                'type' => Type::string(),
                'description' => 'Pipeline name Fr'
            ],
            'internal' => [
                'type' => Type::int(),
                'description' => 'Pipeline internal',
            ],
            'icon' => [
                'type' => Type::string(),
                'description' => 'Pipeline icon name'
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

        $pipeline = Pipeline::where([
            'id' => $args['id'],
            'business_id' => $args['business_id']
        ])->first();
        
        if ($pipeline) {
            if (isset($args['name'])) {
                $pipeline->name = trim($args['name']);
            }

            if (isset($args['name_fr'])) {
                $pipeline->name_fr = trim($args['name_fr']);
            }

            if (isset($args['internal'])) {
                $pipeline->internal = (int) $args['internal'];
            }

            if (isset($args['icon'])) {
                $pipeline->icon = $args['icon'];
            }

            $pipeline->save();
        }

        $pipeline->token = $this->token;
        return $pipeline;
    }
}
