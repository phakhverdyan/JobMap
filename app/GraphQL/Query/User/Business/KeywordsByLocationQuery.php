<?php

namespace App\GraphQL\Query\User\Business;

use App\Certificate;
use App\Keyword;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class KeywordsByLocationQuery extends Query
{
    
    protected $attributes = [
        'name' => 'Keywords by location'
    ];
    
    public function type()
    {
        return Type::listOf(GraphQL::type('KeywordsLocation'));
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'country' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Search by country'
            ],
            'city' => [
                'type' => Type::string(),
                'description' => 'Search by city'
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
        $query = Keyword::query();
        $query->join('business_keywords', 'business_keywords.keyword_id', '=', 'keywords.id');
        $query->join('businesses', 'businesses.id', '=', 'business_keywords.business_id');
        if (isset($args['city'])) {
            $query->where('businesses.city', 'LIKE', str_to_latin($args['city']));
        }
        $query->where('businesses.country', 'LIKE', str_to_latin($args['country']));
        $query->distinct();
        $query->select([
            'keywords.id as id',
            'keywords.name as name',
        ]);
        $dataB = $query->get()->all();
        
        
        $query = Keyword::query();
        
        $query->join('business_job_keywords', 'business_job_keywords.keyword_id', '=', 'keywords.id');
        $query->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_job_keywords.job_id');
        $query->join('business_locations', 'business_locations.id', '=', 'business_job_locations.location_id');
        if (isset($args['city'])) {
            $query->where('business_locations.city', 'LIKE', str_to_latin($args['city']));
        }
        $query->where('business_locations.country', 'LIKE', str_to_latin($args['country']));
        $query->distinct();
        $query->select([
            'keywords.id as id',
            'keywords.name as name',
        ]);
        $dataJ = $query->get()->all();
        
        $data = array_unique(array_merge($dataB, $dataJ));
        
        
        return $data;
    }
}
