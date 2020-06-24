<?php

namespace App\GraphQL\Query\User\Business;

use DB;
use App\Business;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\GraphQL\Extensions\AuthQuery;
use App\GraphQL\OptionalAuth;

class BusinessesSearchQuery extends Query
{
    use OptionalAuth;

    protected $attributes = [
        'name' => 'Businesses'
    ];

    public function type()
    {
        return GraphQL::type('BusinessBrands');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'keywords' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Search location by keywords'
            ],
            'sort' => [
                'type' => Type::string(),
                'description' => 'Set field for order'
            ],
            'order' => [
                'type' => Type::string(),
                'description' => 'Set order'
            ],
            'limit' => [
                'type' => Type::int(),
                'description' => 'Set limit items'
            ],
            'page' => [
                'type' => Type::int(),
                'description' => 'Set current page'
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args)
    {
        $queryString = remove_special_chars($args['keywords']);

        $query = Business::query();

        if ( app()->getLocale() === 'fr' ) {
            $fieldName = 'name_fr';
        } else {
            $fieldName = 'name';
        }

        $query->whereNotNull($fieldName);
        $query->where($fieldName, 'like', '%' . $queryString . '%');

        // Order by newes / oldest
        if (isset($args['sort'])) {

            switch ($args['sort']) {
                case 'newest':
                    $query->orderBy('updated_at', 'desc');
                    break;

                case 'oldest':
                    $query->orderBy('updated_at', 'asc');
                    break;
            }

        } else {
            $query->orderBy('updated_at', 'desc');
        }

        $limit = $args['limit'] ?? 50;
        $page = $args['page'] ?? 1;
        $skip = ($page - 1) * $limit;

        $count = $query->count();
        $query->take($limit)->skip($skip);

        $data = $query->get()->all();

        return array(
            'items' => $data,
            'pages' => ceil($count / $limit),
            'count' => $count,
            'current_page' => $page
        );
    }
}
