<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Business\Administrator;
use App\Candidate\Candidate;
use App\GraphQL\Extensions\AuthQuery;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\App;

class CandidateQuery extends AuthQuery
{
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'businessCandidate'
    ];

    public function type()
    {
        return GraphQL::type('Candidate');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'id'
            ],
            'locale' => [
                'type' => Type::string(),
                'description' => 'The locale'
            ]
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
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
            'view_candidates'
        ];


        $data = Candidate::find($args['id']);

        if (isset($args['locale'])) {
            App::setLocale($args['locale']);
        }

        $data->token = $this->token;

        return $data;
    }
}
