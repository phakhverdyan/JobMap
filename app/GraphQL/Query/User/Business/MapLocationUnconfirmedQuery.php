<?php

namespace App\GraphQL\Query\User\Business;

use App\Business\BusinessUnconfirmedLocation;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Business\Location;
use Illuminate\Support\Facades\DB;

class MapLocationUnconfirmedQuery extends Query
{
    protected $attributes = [
        'name' => 'Location'
    ];
    
    public function type()
    {
        return GraphQL::type('BusinessLocation');
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the location'
            ]
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args)
    {
        $data = BusinessUnconfirmedLocation::find($args['id']);
        
        /*$amenities = [];
        foreach ($data['amenities'] as $amenity) {
            array_push($amenities, $amenity['amenity_id']);
        }
        
        $data['amenities_string'] = implode(',', $amenities);
        
        $departments = [];
        foreach ($data['departments'] as $department) {
            $departments[] = $department['department'];
        }
        $data['assign_departments'] = $departments;
        
        $jobs = [];
        foreach ($data['jobs'] as $job) {
            $jobs[] = $job['job'];
        }
        $data['assign_jobs'] = $jobs;*/
        
        return $data;
    }
}
