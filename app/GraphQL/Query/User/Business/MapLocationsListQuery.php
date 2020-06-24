<?php

namespace App\GraphQL\Query\User\Business;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Business\Location;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\GraphQL\OptionalAuth;

class MapLocationsListQuery extends Query
{
    use OptionalAuth;

    protected $attributes = [
        'name' => 'Location'
    ];
    
    public function type()
    {
        return Type::listOf(GraphQL::type('BusinessLocation'));
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the location'
            ],
            'login_user_id' => [
                'type' => Type::int(),
                'description' => 'The id of the location'
            ],
            'locale' => [
                'type' => Type::string(),
                'description' => 'The locale'
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
        $query = Location::query();
        $ids = explode(',', $args['id']);
        foreach ($ids as $id) {
            $query->orWhere('business_locations.id', '=', $id);
        }
        
        $query->select([
            'business_locations.id as id',
            'business_locations.*',
            DB::raw('(select count(*) from business_job_locations,business_jobs where business_jobs.id = business_job_locations.job_id AND business_jobs.status = 1 AND business_job_locations.location_id = business_locations.id) as jobs_count_open'),
            DB::raw('(select count(*) from business_job_locations,business_jobs where business_jobs.id = business_job_locations.job_id AND business_jobs.status = 0 AND business_job_locations.location_id = business_locations.id) as jobs_count_close')
        ]);
        $query->withCount('jobs');
        $data = $query->get()->all();

        $login_user_id = 0;
        if (isset($args['login_user_id'])) {
            $login_user_id = $args['login_user_id'];
        }
        foreach ($data as $key => $item) {
            $data[$key]['login_user_id'] = $login_user_id;
        }

        if (isset($args['locale'])) {
            App::setLocale($args['locale']);
        }

        return $data;
    }
}
