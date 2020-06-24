<?php

namespace App\GraphQL\Query\User\Business;

use App\Business\Location;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class GetLocationsAutoCompleteQuery extends Query
{
    protected $attributes = [
        'name' => 'GetLocationsAutoComplete'
    ];
    
    public function type()
    {
        return Type::listOf(GraphQL::type('GetLocationsAutoComplete'));
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the business'
            ],
            'job_id' => [
                'type' => Type::id(),
                'description' => 'The id of the job'
            ],
            'key' => [
                'type' => Type::string(),
                'description' => 'Keywords'
            ]
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return array
     */
    public function resolve($root, $args)
    {
        if (isset($args['job_id'])) {
            $data = Location::with('jobs')
                ->where('business_id', $args['business_id'])
                ->whereHas('jobs',function ($query) use ($args) {
                    $query->where('job_id',$args['job_id']);
                })
                //->where('name', 'like', '%' . $args['key'] . '%')
                ->where(function($query) use ($args){
                    $query->where('street', 'like', '%' . $args['key'] . '%')
                        ->orWhere('street_number', 'like', '%' . $args['key'] . '%')
                        ->orWhere('city', 'like', '%' . $args['key'] . '%')
                        ->orWhere('region', 'like', '%' . $args['key'] . '%')
                        ->orWhere('country', 'like', '%' . $args['key'] . '%')
                        ->orWhere('country_code', 'like', '%' . $args['key'] . '%');
                })->get();
        } else {
            $data = Location::where('business_id', $args['business_id'])
                //->where('name', 'like', '%' . $args['key'] . '%')
                ->where(function($query) use ($args){
                    $query->where('street', 'like', '%' . $args['key'] . '%')
                        ->orWhere('street_number', 'like', '%' . $args['key'] . '%')
                        ->orWhere('city', 'like', '%' . $args['key'] . '%')
                        ->orWhere('region', 'like', '%' . $args['key'] . '%')
                        ->orWhere('country', 'like', '%' . $args['key'] . '%')
                        ->orWhere('country_code', 'like', '%' . $args['key'] . '%');
                })->get();
        }
        
        return $data;
    }
}
