<?php

namespace App\GraphQL\Query\User\Business;

use App\Business;
use App\Counter;
use App\Keyword;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\DB;

class ByLocationInfoQuery extends Query
{
    protected $attributes = [
        'name' => 'Information by location'
    ];
    
    public function type()
    {
        return GraphQL::type('ByLocation');
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'findBy' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'country' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'city' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'region' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'street' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'street_number' => [
                'type' => Type::string(),
                'description' => ''
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
        if (isset($args['findBy'])) {
            $queryK = Keyword::query();
            $queryB = Business::query();
            $queryB->join('business_locations', 'business_locations.business_id', '=', 'businesses.id');
            $queryL = Business\Location::query();
            $queryJ = Business\Job::query()
                ->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id')
                ->join('business_locations', 'business_locations.id', '=', 'business_job_locations.location_id');
    
            switch ($args['findBy']) {
                case 'country':
                    $queryB->where('business_locations.country', 'LIKE', str_to_latin($args['country']));
                    
                    $queryL->where('country', 'LIKE', str_to_latin($args['country']));
                    
                    $queryJ->where('business_locations.country', 'LIKE', str_to_latin($args['country']));
                    break;
                case 'city':
                    $queryB->where('business_locations.city', 'LIKE', str_to_latin($args['city']));
                    $queryB->where('business_locations.country', 'LIKE', str_to_latin($args['country']));
                    
                    $queryL->where('city', 'LIKE', str_to_latin($args['city']));
                    $queryL->where('country', 'LIKE', str_to_latin($args['country']));
                    
                    $queryJ->where('business_locations.city', 'LIKE', str_to_latin($args['city']));
                    $queryJ->where('business_locations.country', 'LIKE', str_to_latin($args['country']));
                    break;
                case 'region':
                    $queryB->where('business_locations.region', 'LIKE', str_to_latin($args['region']));
                    $queryB->where('business_locations.country', 'LIKE', str_to_latin($args['country']));
                    
                    $queryL->where('region', 'LIKE', str_to_latin($args['region']));
                    $queryL->where('country', 'LIKE', str_to_latin($args['country']));
                    
                    $queryJ->where('business_locations.region', 'LIKE', str_to_latin($args['region']));
                    $queryJ->where('business_locations.country', 'LIKE', str_to_latin($args['country']));
                    break;
                case 'street':
                    $queryB->where('business_locations.street', 'LIKE', str_to_latin($args['street']));
                    $queryB->where('business_locations.city', 'LIKE', str_to_latin($args['city']));
                    $queryB->where('business_locations.country', 'LIKE', str_to_latin($args['country']));
                    
                    $queryL->where('street', 'LIKE', str_to_latin($args['street']));
                    $queryL->where('city', 'LIKE', str_to_latin($args['city']));
                    $queryL->where('country', 'LIKE', str_to_latin($args['country']));
                    
                    $queryJ->where('business_locations.street', 'LIKE', str_to_latin($args['street']));
                    $queryJ->where('business_locations.city', 'LIKE', str_to_latin($args['city']));
                    $queryJ->where('business_locations.country', 'LIKE', str_to_latin($args['country']));
                    break;
                case 'address':
                    $queryB->where('business_locations.street_number', '=', trim($args['street_number']));
                    $queryB->where('business_locations.street', 'LIKE', str_to_latin($args['street']));
                    $queryB->where('business_locations.city', 'LIKE', str_to_latin($args['city']));
                    $queryB->where('business_locations.country', 'LIKE', str_to_latin($args['country']));
                    
                    $queryL->where('street_number', '=', trim($args['street_number']));
                    $queryL->where('street', 'LIKE', str_to_latin($args['street']));
                    $queryL->where('city', 'LIKE', str_to_latin($args['city']));
                    $queryL->where('country', 'LIKE', str_to_latin($args['country']));
                    
                    $queryJ->where('business_locations.street_number', '=', trim($args['street_number']));
                    $queryJ->where('business_locations.street', 'LIKE', str_to_latin($args['street']));
                    $queryJ->where('business_locations.city', 'LIKE', str_to_latin($args['city']));
                    $queryJ->where('business_locations.country', 'LIKE', str_to_latin($args['country']));
                    break;
                default:
                    return null;
                    break;
            }
            $countK = $queryK->count();
            $countB = $queryB->distinct()->count('businesses.id');
            $cloneL = clone $queryL;
            $countL = $queryL->where('type', 'location')->count();
            $countH = $cloneL->where('type', 'headquarter')->count();
            //$countJ = $queryJ->where('business_job_locations.status', 1)->distinct()->count('business_jobs.id');
            $countJ = $queryJ->distinct()->count('business_jobs.id');

            return [
                'count_employers' => $countB,
                'count_locations' => $countL,
                'count_headquarters' => $countH,
                'count_jobs' => $countJ,
                'count_keywords' => $countK
            ];
        } else {
            $counters = Counter::query()->first();
    
            return [
                'count_employers' => $counters['employers'],
                'count_locations' => $counters['locations'],
                'count_headquarters' => $counters['headquarters'],
                'count_jobs' => $counters['jobs_assign_open'],
                'count_keywords' => $counters['keywords']
            ];
        }
    }
}
