<?php

namespace App\GraphQL\Query;

use App\Amenity;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\App;

class AmenitiesQuery extends Query
{
    
    protected $attributes = [
        'name' => 'amenities'
    ];
    
    public function type()
    {
        return Type::listOf(GraphQL::type('Amenity'));
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
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
        if (isset($args['locale'])) {
            App::setLocale($args['locale']);
        }

        $data = Amenity::get()->all();
        if (App::isLocale('fr')) {
            foreach ($data as $key=>$item) {
                $data[$key]->name = $item->name_fr;
            }
        }
        $data = collect($data)->sortBy('name')->toArray();
        
        return $data;
    }
}
