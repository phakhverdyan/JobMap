<?php

namespace App\GraphQL\Query\User\Business;

use App\Certificate;
use App\Keyword;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class LocationsKeywordsQuery extends Query
{
    
    protected $attributes = [
        'name' => 'Locations Keywords'
    ];
    
    public function type()
    {
        return Type::listOf(GraphQL::type('LocationsKeywords'));
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'country' => [
                'type' => Type::string(),
                'description' => 'Search by country'
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
        $query = Keyword::query();
        $query->join('business_keywords', 'business_keywords.keyword_id', '=', 'keywords.id');
        $query->join('businesses', 'businesses.id', '=', 'business_keywords.business_id');
        $field = 'businesses.country';
        if (isset($args['country'])) {
            $field = 'businesses.city';
            $query->where('businesses.country', 'LIKE', str_to_latin($args['country']));
        }
        $query->distinct();
        $query->select([
            $field . ' as name',
            'businesses.country_code',
        ]);
        $dataB = $query->get()->all();
        
        
        $query = Keyword::query();
        
        $query->join('business_job_keywords', 'business_job_keywords.keyword_id', '=', 'keywords.id');
        $query->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_job_keywords.job_id');
        $query->join('business_locations', 'business_locations.id', '=', 'business_job_locations.location_id');
        $field = 'business_locations.country';
        if (isset($args['country'])) {
            $field = 'business_locations.city';
            $query->where('business_locations.country', 'LIKE', str_to_latin($args['country']));
        }
        $query->distinct();
        $query->select([
            $field . ' as name',
            'business_locations.country_code',
        ]);
        $dataJ = $query->get()->all();
        
        $data = array_unique(array_merge($dataB, $dataJ));
        
        
        return $data;
    }
}
