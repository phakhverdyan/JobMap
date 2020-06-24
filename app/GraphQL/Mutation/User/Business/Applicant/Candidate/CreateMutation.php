<?php

namespace App\GraphQL\Mutation\User\Business\Applicant\Candidate;

use App\Business\Administrator;
use App\Candidate\Candidate;
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
        'name' => 'New candidate for business'
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
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Business id'
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Candidate id'
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
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();

        $where = [
            'business_id' => $args['business_id'],
            'user_id' => $args['user_id'],
            'location_id' => null,
            'job_id' => null

        ];
        $candidate =[];

        if($candidate = Candidate::query()->where($where)->first()) {
            Candidate::query()->where($where)->update([
                'user_id' => $args['user_id']
            ]);
        } else {
            $candidate = new Candidate;
            $candidate->user_id = $args['user_id'];
            $candidate->business_id = $args['business_id'];
            $candidate->pipeline = 'invited';
            $candidate->save();
        }

        $candidate['token'] = $this->token;

        return $candidate;
    }
}
