<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Business\Administrator;
use App\Business\Import;
use App\GraphQL\Extensions\AuthQuery;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class AtsListQuery extends AuthQuery
{
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Ats list'
    ];

    public function type()
    {
        return GraphQL::type('AtsList');
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
            'email' => [
                'type' => Type::string(),
                'description' => 'Search email'
            ],
            'order' => [
                'type' => Type::string(),
                'description' => 'Search order'
            ],
            'direction' => [
                'type' => Type::string(),
                'description' => 'Search order direction'
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

        $data = Import::where(['business_id' => $args['business_id']]);
        $data->where('status', '=', 'Pending');
        if (isset($args['email'])) {
            $data->where('email', 'like', '%' . $args['email'] . '%');
        }
        if (isset($args['order'])) {
            if ($args['order'] === 'name') {
                $data->orderBy('email', $args['direction']);
            }
            if ($args['order'] === 'date') {
                $data->orderBy('sended_at', $args['direction']);
            }
        } else {
            $data->orderBy('sended_at', $args['direction']);
        }

        $items = $data->get()->all();

        if (isset($args['locale'])) {
            App::setLocale($args['locale']);
        }

        return [
            'items' => $items,
            'count' => count($items),
            'token' => $this->token
        ];
    }
}
