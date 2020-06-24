<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Language;

class LanguagesQuery extends Query
{
    
    protected $attributes = [
        'name' => 'Languages'
    ];
    
    public function type()
    {
        return Type::listOf(GraphQL::type('Language'));
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'no_id' => [
                'type' => Type::int(),
                'description' => 'no id language'
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
        $query = Language::query();

        if (isset($args['no_id'])) {
            $query->where('id', '!=', $args['no_id']);
        }

        // throw new \Exception('OY!');

        $data = $query->get();
        return $data;
    }
}
