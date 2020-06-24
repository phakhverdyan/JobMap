<?php

namespace App\GraphQL\Mutation\User\Business\Applicant\Candidate;

use App\Business\Administrator;
use App\Candidate\Candidate;
use App\Candidate\History;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Mail;

class UpdateClickedOnMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'Update Pipeline for candidate'
    ];
    
    public function type()
    {
        return GraphQL::type('Candidate');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
        
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'candidate_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'User id'
            ],
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Business id'
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
        $this->permissions = [
            'candidates'
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();

        $business = \App\Business::where('id', $args['business_id'])->first();

        if (!$candidate = Candidate::where('id', $args['candidate_id'])->first()) {
            throw new \Exception('Candidate not found');
        }
        
        $candidate->business_clicked_on = true;
        $candidate->save();
        $candidate->token = $this->token;
        return $candidate;
    }
}
