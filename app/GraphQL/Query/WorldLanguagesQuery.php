<?php

namespace App\GraphQL\Query;

use App\WorldLanguage;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class WorldLanguagesQuery extends Query
{
    
    protected $attributes = [
        'name' => 'World languages'
    ];
    
    public function type()
    {
        return GraphQL::type('WorldLanguages');
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'keywords' => [
                'type' => Type::string(),
                'description' => 'Search by keywords'
            ],
            'default' => [
                'type' => Type::string(),
                'description' => 'Get default item by ids'
            ],
            'locale' => [
                'type' => Type::string(),
                'description' => 'locale'
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
        $query = WorldLanguage::query();
        
        if (isset($args['keywords'])) {
            $query->where('name', 'like', '%' . $args['keywords'] . '%');
        }
        
        $data['items'] = $query->limit(20)->get()->all();
    
        if (isset($args['default'])) {
            $ids = explode(',', $args['default']);
            $data['default'] = WorldLanguage::whereIn('id', $ids)->get()->all();
        }
        
        return $data;
    }
}
