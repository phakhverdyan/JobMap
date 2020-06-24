<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\GraphQL\Extensions\AuthQuery;
use GraphQL;
use GraphQL\Type\Definition\Type;
use App\Business;
use Illuminate\Support\Facades\DB;

class BusinessesQuery extends AuthQuery
{
    protected $attributes = [
        'name' => 'Businesses'
    ];
    
    public function type()
    {
        return Type::listOf(GraphQL::type('Business'));
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [];
    }
    
    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args)
    {
        $query = Business::query();
        $query->whereNull('parent_id');
        $query->join('business_administrators', 'business_administrators.business_id','=', 'businesses.id');
        $query->where('business_administrators.user_id', '=', $this->auth->id);

        $query->select([
            'businesses.*',
            DB::raw('(select count(*) from business_locations where business_locations.business_id = businesses.id AND business_locations.type = "headquarter") as headquarters_count'),
            DB::raw('(select count(*) from business_locations where business_locations.business_id = businesses.id AND business_locations.type = "location") as locations_count'),
            DB::raw('(select count(*) from business_jobs where business_jobs.business_id = businesses.id) as jobs_count'),
            DB::raw('(select count(*) from business_jobs where business_jobs.business_id = businesses.id) as all_jobs_count'),
        ]);
        
        $data = $query->get();
        
        foreach ($data as $business) {
            $business->realtime_token = hash_hmac('sha256', $business->id, 'Bobik-realtime-Business-token');
        }

        if (count($data) > 0) {
            $data[0]['token'] = $this->token;
        }

        return $data;
    }
}
