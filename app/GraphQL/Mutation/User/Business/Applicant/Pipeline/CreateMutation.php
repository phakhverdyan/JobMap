<?php

namespace App\GraphQL\Mutation\User\Business\Applicant\Pipeline;

use App\Business\Administrator;
use App\Business\Pipeline;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class CreateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'New Pipeline item'
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
            'name' => ['required', 'string'],
            'name_fr' => ['string'],
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
                'description' => 'Business id',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Pipeline Name En',
            ],
            'name_fr' => [
                'type' => Type::string(),
                'description' => 'Pipeline Name Fr',
            ],
            'icon' => [
                'type' => Type::string(),
                'description' => 'Pipeline Icon',
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
//        $this->permissions = [
//            'departments'
//        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();
        
        $data = new Pipeline();
        $data->business_id = $args['business_id'];
        $data->name = $args['name'];
        $data->name_fr = $args['name_fr'];
        $data->icon = ($args['icon'] ?? 'default');
        $data->save();
    
        $data = Pipeline::where([
            'business_id' => $args['business_id']
        ])->orderBy('position')->get();
    
        return [
            'items' => $data,
            'token' => $this->token
        ];
    }
}
