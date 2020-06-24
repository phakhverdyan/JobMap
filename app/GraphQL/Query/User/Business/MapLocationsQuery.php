<?php

namespace App\GraphQL\Query\User\Business;

use App\Business\BusinessUnconfirmedLocation;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Business\Location;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class MapLocationsQuery extends Query
{
    protected $attributes = [
        'name' => 'All Locations'
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
//            'job_status' => [
//                'type' => Type::int(),
//                'description' => ''
//            ],
            'hours_from' => [
                'type' => Type::int(),
                'description' => ''
            ],
            'hours_to' => [
                'type' => Type::int(),
                'description' => ''
            ],
//            'careers' => [
//                'type' => Type::string(),
//                'description' => 'Career level'
//            ],
//            'job_types' => [
//                'type' => Type::string(),
//                'description' => 'Job Types'
//            ],
            'b_name' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'title' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'location' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'career_status' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'work_status' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'job_status' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'options' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'popular_industries' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'amenities' => [
                'type' => Type::string(),
                'description' => ''
            ],
//            'hours' => [
//                'type' => Type::string(),
//                'description' => ''
//            ],
            'categories' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'types' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'certifications' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'languages' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'departments' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'time_1' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'time_2' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'time_3' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'time_4' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'posted' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'employers' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'careers' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'sizes' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'a_keywords' => [
                'type' => Type::string(),
                'description' => ''
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
        if (!isset($args['hours_from'])) {
            $args['hours_from'] = 0;
        }
        if (!isset($args['hours_to'])) {
            $args['hours_to'] = 80;
        }
        $query = Location::query();
        $query->with(['business', 'business.jobs', 'business.locations', 'jobs']);
        $query->join('businesses', 'businesses.id', '=', 'business_locations.business_id');

        $query->join('business_job_locations', 'business_job_locations.location_id', '=', 'business_locations.id', 'left');
        $query->join('business_jobs', 'business_job_locations.job_id', '=', 'business_jobs.id', 'left');

        if (isset($args['b_name'])) {
            $t = $args['b_name'];
            // $query->where('businesses.name', 'like', '%' . $t . '%');
        }
        if (isset($args['title'])) {
            $t = $args['title'];
            //$query->where('title', 'like', '%' . $t . '%');
            $query->where(function ($q) use ($t) {
                $q->orWhere('businesses.name', 'like', '%' . $t . '%');
                $q->orWhere('businesses.name_fr', 'like', '%' . $t . '%');
                $q->orWhere('business_jobs.title', 'like', '%' . $t . '%');
            });

        }
        if (isset($args['location'])) {
            $l = trim($args['location']);
            $query->where(function ($query) use ($l) {
                $query->orWhere('business_locations.name', 'like', '%' . $l . '%');
                $query->orWhere('business_locations.name_fr', 'like', '%' . $l . '%');
                $query->orWhere('business_locations.street_number', '=', $l);
                $query->orWhere('business_locations.street', 'like', '%' . $l . '%');
                $query->orWhere('business_locations.city', 'like', '%' . $l . '%');
                $query->orWhere('business_locations.region', 'like', '%' . $l . '%');
                $query->orWhere('business_locations.country', 'like', '%' . str_to_latin($l) . '%');
                $val = str_to_latin($l);
                $items = str_replace(',', ' ', $val);
                $items = explode(' ', $items);
                foreach ($items as $item) {
                    $query->orWhere('business_locations.name', 'like', '%' . $item . '%');
                    $query->orWhere('business_locations.name_fr', 'like', '%' . $item . '%');
                    $query->orWhere('business_locations.street_number', 'like', '%' . $item . '%');
                    $query->orWhere('business_locations.street', 'like', '%' . $item . '%');
                    $query->orWhere('business_locations.city', 'like', '%' . $item . '%');
                    $query->orWhere('business_locations.region', 'like', '%' . $item . '%');
                    $query->orWhere('business_locations.country', 'like', '%' . $item . '%');
                }
            });
        }
        if (isset($args['time_1'])) {
            $query->where('business_jobs.time_1', $args['time_1']);
        }
        if (isset($args['time_2'])) {
            $query->where('business_jobs.time_2', $args['time_2']);
        }
        if (isset($args['time_3'])) {
            $query->where('business_jobs.time_3', $args['time_3']);
        }
        if (isset($args['time_4'])) {
            $query->where('business_jobs.time_4', $args['time_4']);
        }
        if (isset($args['job_status'])) {
            $data = explode(',', $args['job_status']);
            $query->whereIn('business_jobs.status', $data);
        }
        if (isset($args['popular_industries'])) {
            $data = explode(',', $args['popular_industries']);
            $query->whereIn('businesses.industry_id', $data);
        }
        if (isset($args['categories'])) {
            $data = explode(',', $args['categories']);
            $query->whereIn('business_jobs.category_id', $data);
        }
        if (isset($args['posted'])) {
            $data = explode(',', $args['posted']);
            foreach ($data as $item) {
                $query->where(function ($query) use ($item) {
                    $query->where('business_jobs.created_at', '<=', date('Y-m-d H:i:s'));
                    $query->where('business_jobs.created_at', '>=', date('Y-m-d H:i:s', strtotime('- ' . $item, time())));
                });
            }
        }
        if (isset($args['sizes'])) {
            $data = explode(',', $args['sizes']);
            $query->whereIn('businesses.size_id', $data);
        }
        if (isset($args['employers'])) {
            $data = explode(',', $args['employers']);
            $query->whereIn('businesses.type', $data);
        }
        if (isset($args['amenities'])) {
            $query->join('business_location_amenities', 'business_location_amenities.location_id', '=', 'business_locations.id');
            $data = explode(',', $args['amenities']);
            $query->whereIn('business_location_amenities.amenity_id', $data);
        }
        if (isset($args['hours_from']) && isset($args['hours_to'])) {
            if ($args['hours_from'] != 0) {
                $query->where('business_jobs.hours', '>=', $args['hours_from']);
            }
            if ($args['hours_to'] != 80) {
                $query->where('business_jobs.hours', '<=', $args['hours_to']);
            }
        }
        if (isset($args['careers'])) {
            $query->join('business_job_career_levels', 'business_job_career_levels.job_id', '=', 'business_jobs.id');
            $data = explode(',', $args['careers']);
            $query->whereIn('business_job_career_levels.career_id', $data);
        }
        if (isset($args['types'])) {
            $query->join('business_job_types', 'business_job_types.job_id', '=', 'business_jobs.id');
            $data = explode(',', $args['types']);
            $query->whereIn('business_job_types.type_id', $data);
        }
        if (isset($args['languages'])) {
            $query->join('business_job_languages', 'business_job_languages.job_id', '=', 'business_jobs.id');
            $data = explode(',', $args['languages']);
            $query->whereIn('business_job_languages.world_language_id', $data);
        }
        if (isset($args['certifications'])) {
            $query->join('business_job_certificates', 'business_job_certificates.job_id', '=', 'business_jobs.id');
            $data = explode(',', $args['certifications']);
            $query->whereIn('business_job_certificates.certificate_id', $data);
        }
        if (isset($args['departments'])) {
            $query->join('business_job_departments', 'business_job_departments.job_id', '=', 'business_jobs.id');
            $data = explode(',', $args['departments']);
            $query->whereIn('business_job_departments.department_id', $data);
        }
        if (isset($args['career_status'])) {
            $data = explode(',', $args['career_status']);
            $query->where(function ($query) use ($data) {
                foreach ($data as $item) {
                    $query->orWhere('business_jobs.career_status', 'like', '%' . $item . '%');
                }
            });
        }
        if (isset($args['work_status'])) {
            $data = explode(',', $args['work_status']);
            $query->where(function ($query) use ($data) {
                foreach ($data as $item) {
                    $query->orWhere('business_jobs.work_status', 'like', '%' . $item . '%');
                }
            });
        }
        if (isset($args['options'])) {
            $data = explode(',', $args['options']);
            $query->where(function ($query) use ($data) {
                foreach ($data as $item) {
                    $query->orWhere('business_jobs.options', 'like', '%' . $item . '%');
                }
            });
        }
        if (isset($args['a_keywords'])) {
            $data = explode(',', $args['a_keywords']);
            $query->join('business_job_keywords', 'business_job_keywords.job_id', '=', 'business_jobs.id');
            $query->join('business_keywords', 'business_keywords.business_id', '=', 'businesses.id');
            $query->where(function ($query) use ($data) {
                $query->orWhereIn('business_job_keywords.keyword_id', $data);
                $query->orWhereIn('business_keywords.keyword_id', $data);
            });
        }

        $query->distinct();
        $query->select([
            'business_locations.id as id',
            'business_locations.*',
            // DB::raw('(select count(*) from business_job_locations,business_jobs where business_jobs.id = business_job_locations.job_id AND business_jobs.status = 1 AND business_job_locations.location_id = business_locations.id) as jobs_count_open'),
            // DB::raw('(select count(*) from business_job_locations,business_jobs where business_jobs.id = business_job_locations.job_id AND business_jobs.status = 0 AND business_job_locations.location_id = business_locations.id) as jobs_count_close')
        ]);
        $data = $query->get();

        return array(
            'items' => $data,
            'items_u' => $this->getUnconfirmed($args)
        );
    }

    private function getUnconfirmed ($args)
    {
        $locations = BusinessUnconfirmedLocation::with('business')
            ->whereHas('business', function ($query) use ($args){
                if (isset($args['b_name'])) {
                    $t = $args['b_name'];
                    $query->where('name', 'like', '%' . $t . '%');
                }
                if (isset($args['title'])) {
                    $t = $args['title'];
                    $query->where(function ($q) use ($t) {
                        $q->where('name', 'like', '%' . $t . '%');
                    });
                }
            })
            ->where(function ($query) use ($args){
                if (isset($args['location'])) {
                    $l = trim($args['location']);
                    $query->orWhere('street_number', '=', $l);
                    $query->orWhere('street', 'like', '%' . str_to_latin($l) . '%');
                    $query->orWhere('city', 'like', '%' . str_to_latin($l) . '%');
                    $query->orWhere('region', 'like', '%' . str_to_latin($l) . '%');
                    $query->orWhere('country', 'like', '%' . str_to_latin($l) . '%');
                    $val = str_to_latin($l);
                    $items = str_replace(',', ' ', $val);
                    $items = explode(' ', $items);
                    foreach ($items as $item) {
                        $query->orWhere('street_number', 'like', '%' . $item . '%');
                        $query->orWhere('street', 'like', '%' . $item . '%');
                        $query->orWhere('city', 'like', '%' . $item . '%');
                        $query->orWhere('region', 'like', '%' . $item . '%');
                        $query->orWhere('country', 'like', '%' . $item . '%');
                    }
                }
            })
            ->get();

        /*$query = Location::query();
        $query->join('businesses', 'businesses.id', '=', 'business_locations.business_id');

        $query->join('business_job_locations', 'business_job_locations.location_id', '=', 'business_locations.id', 'left');
        $query->join('business_jobs', 'business_job_locations.job_id', '=', 'business_jobs.id', 'left');

        if (isset($args['b_name'])) {
            $t = $args['b_name'];
            $query->where('businesses.name', 'like', '%' . $t . '%');
        }
        if (isset($args['title'])) {
            $t = $args['title'];
            $query->where('businesses.name', 'like', '%' . $t . '%');
        }
        if (isset($args['location'])) {
            $l = trim($args['location']);
            $query->where(function ($query) use ($l) {
                $query->orWhere('business_locations.street_number', '=', $l);
                $query->orWhere('business_locations.street', 'like', '%' . str_to_latin($l) . '%');
                $query->orWhere('business_locations.city', 'like', '%' . str_to_latin($l) . '%');
                $query->orWhere('business_locations.region', 'like', '%' . str_to_latin($l) . '%');
                $query->orWhere('business_locations.country', 'like', '%' . str_to_latin($l) . '%');
                $val = str_to_latin($l);
                $items = str_replace(',', ' ', $val);
                $items = explode(' ', $items);
                foreach ($items as $item) {
                    $query->orWhere('business_locations.street_number', 'like', '%' . $item . '%');
                    $query->orWhere('business_locations.street', 'like', '%' . $item . '%');
                    $query->orWhere('business_locations.city', 'like', '%' . $item . '%');
                    $query->orWhere('business_locations.region', 'like', '%' . $item . '%');
                    $query->orWhere('business_locations.country', 'like', '%' . $item . '%');
                }
            });
        }*/


        return $locations;
    }
}
