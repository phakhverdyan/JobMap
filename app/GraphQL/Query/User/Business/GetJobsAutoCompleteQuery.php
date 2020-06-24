<?php

namespace App\GraphQL\Query\User\Business;

use App\Business\Job;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class GetJobsAutoCompleteQuery extends Query
{
    protected $attributes = [
        'name' => 'getJobsAutoComplete'
    ];
    
    public function type()
    {
        return Type::listOf(GraphQL::type('GetJobsAutoComplete'));
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
            'location_id' => [
                'type' => Type::id(),
                'description' => 'The id of the location'
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
        if (isset($args['location_id'])) {
            $data = Job::with('locations')
                ->where('business_id', $args['business_id'])
                ->where('title', 'like', '%' . $args['key'] . '%')
                ->whereHas('locations',function ($query) use ($args) {
                    $query->where('location_id',$args['location_id']);
                })->get();
        } else {
            $data = Job::where('business_id', $args['business_id'])
                ->where('title', 'like', '%' . $args['key'] . '%')
                ->get();
        }
        
        return $data;
    }
}
