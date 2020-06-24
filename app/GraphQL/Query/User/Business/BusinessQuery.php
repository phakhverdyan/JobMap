<?php

namespace App\GraphQL\Query\User\Business;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Business;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\GraphQL\OptionalAuth;

class BusinessQuery extends Query
{
    use OptionalAuth;

    protected $attributes = [
        'name' => 'Business'
    ];

    public function type()
    {
        return GraphQL::type('Business');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the business'
            ],
            'locale' => [
                'type' => Type::string(),
                'description' => 'The locale'
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
        $jobsCount = 0;

        $businessIDs = [];
        $business = Business::where('id', $args['id'])->firstOrFail();

        if ($business->parent_id) {
            $business = Business::where('id', $business->parent_id)->firstOrFail();
        }

        $query = Business::query();
        $query->where('id', $args['id']);

        $query->select([
            'businesses.*',
            DB::raw('(select count(*) from business_locations where business_locations.business_id = businesses.id AND business_locations.type = "headquarter") as headquarters_count'),
            DB::raw('(select count(*) from business_locations where business_locations.business_id = businesses.id AND business_locations.type = "location") as locations_count'),
            //DB::raw('(select count(distinct business_jobs.id) from business_jobs inner join business_job_locations on business_job_locations.job_id = business_jobs.id where business_job_locations.status = 1 and business_jobs.business_id = businesses.id) as jobs_count')
            DB::raw('(select count(business_jobs.id) from business_jobs inner join business_job_locations on business_job_locations.job_id = business_jobs.id where business_jobs.business_id = businesses.id) as jobs_count'),
            DB::raw('(select count(businesses.id) from businesses where businesses.id = '. $business->id .' or businesses.parent_id = '. $business->id .') as brands_count')
            // DB::raw('(select count(businesses.id) from businesses where businesses.parent_id = '. $args['id'] .') as brands_count')
        ]);
        $data = $query->first();

        if (!$data) {
            return false;
        }

        $keywords = [];
        if (!empty($data['keywords'])) {
            foreach ($data['keywords'] as $keyword) {
                $keywords[] = $keyword['keyword'];
            }
        }

//        if (!empty($business->jobs)) {
//            foreach ($business->jobs as $job) {
//                foreach ($job->locationsAll as $location) {
//                    if ($location->location->business->getKey() == $args['id']) {
//                        $jobsCount++;
//                    }
//                }
//            }
//        }

        $data['keywords'] = $keywords;
        $data['owner'] = '';
        $data['all_jobs_count'] = $data['jobs_count'];//$jobsCount;

        $ownerQuery = Business::query();
        $ownerQuery->select('first_name', 'last_name')
            ->where('businesses.id', '=', $args['id'])
            ->where('business_administrators.role', '=', 'admin')
            ->join('business_administrators', 'businesses.id', '=', 'business_administrators.business_id')
            ->join('users', 'business_administrators.user_id', '=', 'users.id');
        if ($ownerData = $ownerQuery->first()) {
            $data['owner'] = $ownerData->first_name . ' ' . $ownerData->last_name;
        }

        return $data;
    }
}
