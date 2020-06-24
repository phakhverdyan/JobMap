<?php
namespace App\GraphQL\Query\User\Business;

use App\Business\WebsiteWidget;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class WebsiteWidgetQuery extends Query
{

    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Website Widget'
    ];

    public function type()
    {
        return GraphQL::type('WebsiteWidget');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The ID of the widget'
            ],
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The ID of the business'
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
        $query = WebsiteWidget::query();
        $query->where('business_id', $args['business_id']);
        $query->where('id', $args['id']);
        return $query->first();
    }
}
