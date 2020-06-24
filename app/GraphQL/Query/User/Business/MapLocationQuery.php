<?php

namespace App\GraphQL\Query\User\Business;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Business\Location;
use Illuminate\Support\Facades\DB;
use App\GraphQL\OptionalAuth;

class MapLocationQuery extends Query
{
    use OptionalAuth;

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
            ],
            'locale' => [
                'type' => Type::string(),
                'description' => 'The output content language prefix'
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
        unset($args['locale']);
        $query = Location::query();
        foreach ($args as $field => $value) {
            $query->where($field, $value);
        }
        $query->select([
            'business_locations.id as id',
            'business_locations.*',
            DB::raw('(select count(*) from business_job_locations,business_jobs where business_jobs.id = business_job_locations.job_id AND business_job_locations.status = 1 AND business_job_locations.location_id = business_locations.id) as jobs_count_open'),
            DB::raw('(select count(*) from business_job_locations,business_jobs where business_jobs.id = business_job_locations.job_id AND business_job_locations.status = 0 AND business_job_locations.location_id = business_locations.id) as jobs_count_close')
        ]);
        $query->withCount('jobs');
        $data = $query->first();
        
        $amenities = [];
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
        $data['assign_jobs'] = $jobs;
        
        return $data;
    }
}
