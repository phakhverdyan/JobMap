<?php

namespace App\GraphQL\Query;

use App\Certificate;
use App\Keyword;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\App;

class KeywordsQuery extends Query
{
    
    protected $attributes = [
        'name' => 'Keywords'
    ];
    
    public function type()
    {
        return GraphQL::type('Keywords');
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
            ],
            'language_prefix' => [
                'type' => Type::string(),
                'description' => 'Prefix of keywords language to search',
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
        if (isset($args['locale'])) {
            App::setLocale($args['locale']);
        }

        $query = Keyword::query();

        if (isset($args['language_prefix']) && $args['language_prefix']) {
            $query->where('language_prefix', $args['language_prefix']);
        }
        
        if (isset($args['keywords'])) {
            $query->where('name', 'like', '%' . $args['keywords'] . '%');
        }
        
        $data['items'] = $query->limit(20)->get();
    
        if (isset($args['default'])) {
            $ids = explode(',', $args['default']);
            $data['default'] = Keyword::whereIn('id', $ids)->get();
        }
        
        return $data;
    }
}
