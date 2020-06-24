<?php

namespace App\GraphQL\Query;

use App\Industry;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\App;

class IndustriesQuery extends Query
{
    
    protected $attributes = [
        'name' => 'Industries'
    ];
    
    public function type()
    {
        return Type::listOf(GraphQL::type('Industry'));
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'parent_id' => [
                'type' => Type::string(),
                'description' => 'Industries parent ids',
            ],

            'locale' => [
                'type' => Type::string(),
                'description' => 'locale',
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
        if (isset($args['locale']) && $args['locale']) {
            \App::setLocale($args['locale']);
        }

        $query = Industry::query();

        if (isset($args['parent_id'])) {
            $ids = explode(",", $args['parent_id']);
            $query->whereIn('parent_id', $ids);
        }
        else {
            $query->where('parent_id', null);
        }

        if (\App::getLocale() != 'en' && in_array(\App::getLocale(), ['fr'])) {
            $query->orderBy('name_' . \App::getLocale())->orderBy('name');
        }
        else {
            $query->orderBy('name');
        }

        $data = $query->get();
        return $data;
    }
}
