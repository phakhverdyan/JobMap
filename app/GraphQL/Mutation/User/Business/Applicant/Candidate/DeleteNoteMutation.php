<?php

namespace App\GraphQL\Mutation\User\Business\Applicant\Candidate;

use App\Business\Administrator;
use App\Candidate\Note;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use Folklore\GraphQL\Error\ValidationError;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Input;

class DeleteNoteMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'New note for candidate'
    ];
    
    public function type()
    {
        return GraphQL::type('DeleteNote');
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
                'description' => 'ntes id'
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
            'candidates'
        ];
        //set business ID
        //$this->businessID = $args['business_id'];
        //check permissions
        //$this->check();

        Note::where('id', $args['id'])->delete();

        $data = [];
        $data['response'] = 'ok';
        $data['token'] = $this->token;
    
        return $data;
    }
}
