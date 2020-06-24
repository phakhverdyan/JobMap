<?php

namespace App\GraphQL\Query\User\Business;

use DB;
use App\Business\Location;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\GraphQL\Extensions\AuthQuery;
use App\GraphQL\OptionalAuth;

class LocationsSearchQuery extends Query
{
    use OptionalAuth;

    protected $attributes = [
        'name' => 'Locations'
    ];

    public function type()
    {
        return GraphQL::type('BusinessLocations');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'keywords' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Search location by keywords'
            ],
            'sort' => [
                'type' => Type::string(),
                'description' => 'Set field for order'
            ],
            'order' => [
                'type' => Type::string(),
                'description' => 'Set order'
            ],
            'limit' => [
                'type' => Type::int(),
                'description' => 'Set limit items'
            ],
            'page' => [
                'type' => Type::int(),
                'description' => 'Set current page'
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
        $queryString = remove_special_chars($args['keywords']);

        $query = Location::with(['business']);

        if ( app()->getLocale() === 'fr' ) {
            $fieldName = 'name_fr';
        } else {
            $fieldName = 'name';
        }

        $query->whereNotNull('business_locations.' . $fieldName);
        // $query->orWhere($fieldName, 'like', '%' . $queryString . '%');
        $query->where('business_locations.' . $fieldName, 'like', '%' . $queryString . '%');

        // search by businesses name
        $query->join('businesses', 'business_locations.business_id', '=', 'businesses.id');
        $query->orWhere('businesses.' . $fieldName, 'like', '%' . $queryString . '%');

        // search by address
        $query->orWhere(function ($query) use ($queryString) {
            // $query->orWhere($fieldName, 'like', '%' . $queryString . '%');
            $query->orWhere('business_locations.street', 'like', '%' . $queryString . '%');
            $query->orWhere('business_locations.city', 'like', '%' . $queryString . '%');
            $query->orWhere('business_locations.region', 'like', '%' . $queryString . '%');
            $query->orWhere('business_locations.country', 'like', '%' . $queryString . '%');
            $query->orWhere('business_locations.street_number', 'like', '%' . $queryString . '%');
        });

        // Order by newes / oldest
        if (isset($args['sort'])) {

            switch ($args['sort']) {
                case 'newest':
                    $query->orderBy('updated_at', 'desc');
                    break;

                case 'oldest':
                    $query->orderBy('updated_at', 'asc');
                    break;
            }

        } else {
            $query->orderBy('updated_at', 'desc');
        }

        $query->select([
            'business_locations.id as id',
            'business_locations.*',
            DB::raw('(select count(*) from business_job_locations,business_jobs where business_jobs.id = business_job_locations.job_id AND business_jobs.status = 1 AND business_job_locations.location_id = business_locations.id) as jobs_count_open'),
            DB::raw('(select count(*) from business_job_locations,business_jobs where business_jobs.id = business_job_locations.job_id AND business_jobs.status = 0 AND business_job_locations.location_id = business_locations.id) as jobs_count_close')
        ]);

        $query->distinct();

        $limit = $args['limit'] ?? 50;
        $page = $args['page'] ?? 1;
        $skip = ($page - 1) * $limit;

        $count = $query->count();
        $query->take($limit)->skip($skip);

        $data = $query->get()->all();

        return array(
            'items' => $data,
            'pages' => ceil($count / $limit),
            'count' => $count,
            'current_page' => $page
        );
    }
}
