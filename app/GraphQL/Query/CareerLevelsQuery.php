<?php

namespace App\GraphQL\Query;

use App\CareerLevel;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\App;

class CareerLevelsQuery extends Query
{
    
    protected $attributes = [
        'name' => 'Career Levels'
    ];
    
    public function type()
    {
        return GraphQL::type('CareerLevels');
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
        $query = CareerLevel::query();

        if (isset($args['keywords'])) {
            if (App::isLocale('fr')) {
                $query->where('name_fr', 'like', '%' . $args['keywords'] . '%');
            } else {
                $query->where('name', 'like', '%' . $args['keywords'] . '%');
            }
        }
        
        $data['items'] = $query->limit(20)->get()->all();
        if (App::isLocale('fr')) {
            foreach ($data['items'] as $key=>$item) {
                $data['items'][$key]->name = $item->name_fr;
            }
        }
        //$data['items'] = collect($data['items'])->sortBy('name')->toArray();
    
        if (isset($args['default'])) {
            $ids = explode(',', $args['default']);
            $data['default'] = CareerLevel::whereIn('id', $ids)->get()->all();
            if (App::isLocale('fr')) {
                foreach ($data['default'] as $key=>$item) {
                    $data['default'][$key]->name = $item->name_fr;
                }
            }
            //$data['default'] = collect($data['default'])->sortBy('name')->toArray();
        }

        return $data;
    }
}
