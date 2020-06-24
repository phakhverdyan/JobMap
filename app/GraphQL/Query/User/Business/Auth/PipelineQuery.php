<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Business\Administrator;
use App\Business\Pipeline;
use App\Candidate;
use App\GraphQL\Extensions\AuthQuery;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class PipelineQuery extends AuthQuery
{
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Pipelines'
    ];

    public function type()
    {
        return GraphQL::type('Pipeline');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the business'
            ],

            'looking_job' => [
                'type' => Type::string(),
                'description' => 'Set order'
            ],
            'its_urgent' => [
                'type' => Type::string(),
                'description' => 'Set order'
            ],
            'new_job' => [
                'type' => Type::string(),
                'description' => 'Set order'
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return array
     */
    public function resolve($root, $args)
    {
        //set authorized roles
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::FRANCHISE_ROLE,
            Administrator::BRANCH_ROLE
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();

        $data = Pipeline::where([
            'business_id' => $args['business_id']
        ])->orderBy('position')->get();

        // foreach ($data as $key => $item) {
        //     if ($item->not_delete) {
        //         $data[$key]->name = trans('db.pipelines.' . $item->type_new);
        //     }
        // }

        return [
            'items' => $data,
            'token' => $this->token
        ];
    }
}
