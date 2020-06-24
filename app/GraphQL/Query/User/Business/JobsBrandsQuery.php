<?php

namespace App\GraphQL\Query\User\Business;

use App\Business;
use App\Business\Job;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\GraphQL\OptionalAuth;

class JobsBrandsQuery extends Query
{
    use OptionalAuth;

    protected $attributes = [
        'name' => 'Jobs'
    ];
    
    public function type()
    {
        return GraphQL::type('BusinessJobs');
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
        $data = Job::where('business_jobs.business_id',$args['business_id'])
            ->orWhereHas('business', function ($query) use ($args)  {
                $query->where('parent_id', $args['business_id']);
            })
            ->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id')
            ->join('business_locations', 'business_job_locations.location_id', '=', 'business_locations.id')
            ->join('businesses', 'businesses.id', '=', 'business_locations.business_id')
            ->select('business_jobs.*', 'business_locations.business_id as business_locations__business_id', 'businesses.name as business__name')
            ->distinct()
            ->get();
        //->groupBy('business_locations__business_id')

        return array(
            'items' => $data,
        );
    }
}
