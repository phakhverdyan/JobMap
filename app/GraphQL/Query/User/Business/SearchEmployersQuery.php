<?php

namespace App\GraphQL\Query\User\Business;

use App\Business;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\DB;

class SearchEmployersQuery extends Query
{
    protected $attributes = [
        'name' => 'All Locations'
    ];
    
    public function type()
    {
        return GraphQL::type('Businesses');
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
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
            'hours' => [
                'type' => Type::string(),
                'description' => ''
            ],
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
     * @return array|null
     */
    public function resolve($root, $args)
    {
        $query = Business::query();
        
        $query->join('business_locations', 'business_locations.business_id', '=', 'businesses.id');
        $query->join('business_job_locations', 'business_job_locations.location_id', '=', 'business_locations.id', 'left');
        
        
        $query->join('business_jobs', 'business_jobs.id', '=', 'business_job_locations.job_id', 'left');
        if (isset($args['title']) && !empty($args['title'])) {
            $t = $args['title'];
            $query->where(function ($query) use ($t) {
                $query->where('title', 'like', '%' . $t . '%');
                $query->orWhere('businesses.name', 'like', '%' . $t . '%');
            });
        }
        if (isset($args['location']) && !empty($args['location'])) {
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
        if (isset($args['hours'])) {
            $query->where('hours', '=', $args['hours']);
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
            $query->join('business_job_keywords', 'business_job_keywords.job_id', '=', 'business_jobs.id', 'left');
            $query->join('business_keywords', 'business_keywords.business_id', '=', 'businesses.id');
            $query->where(function ($query) use ($data) {
                $query->orWhereIn('business_job_keywords.keyword_id', $data);
                $query->orWhereIn('business_keywords.keyword_id', $data);
            });
        }
        
        
        $limit = $args['limit'] ?? 25;
        $page = $args['page'] ?? 1;
        $skip = ($page - 1) * $limit;
        if (isset($args['keywords'])) {
            $value = $args['keywords'];
            $query->where(function ($query) use ($value, $args) {
                $query->orWhere('businesses.name', 'like', '%' . $value . '%');
                $query->orWhere(function ($query) use ($value) {
                    $query->whereIn('business_job_locations.job_id', function ($q) use ($value) {
                        $q->select('job_id')
                            ->from('business_job_types')
                            ->join('job_types', 'job_types.id', '=', 'business_job_types.type_id')
                            ->where('job_types.name', 'like', '%' . $value . '%');
                    });
                });
                switch ($args['findBy']) {
                    case 'country':
                        $query->orWhere('business_locations.street', 'LIKE', '%' . $value . '%');
                        $query->orWhere('business_locations.city', 'LIKE', '%' . $value . '%');
                        $query->orWhere('business_locations.region', 'LIKE', '%' . $value . '%');
                        $items = explode(' ', $value);
                        foreach ($items as $item) {
                            $query->orWhere('business_locations.street_number', 'LIKE', '%' . $item . '%');
                        }
                        break;
                    case 'city':
                        $query->orWhere('business_locations.street', 'LIKE', '%' . $value . '%');
                        $items = explode(' ', $value);
                        foreach ($items as $item) {
                            $query->orWhere('business_locations.street_number', 'LIKE', '%' . $item . '%');
                        }
                        break;
                    case 'region':
                        $query->orWhere('business_locations.street', 'LIKE', '%' . $value . '%');
                        $query->orWhere('business_locations.city', 'LIKE', '%' . $value . '%');
                        $items = explode(' ', $value);
                        foreach ($items as $item) {
                            $query->orWhere('business_locations.street_number', 'LIKE', '%' . $item . '%');
                        }
                        break;
                }
            });
        }
        if (isset($args['sort'])) {
            $order = $args['order'] ?? 'asc';
            if ($args['sort'] == 'created_date') {
                $query->orderBy('businesses.created_at', $order);
            } else {
                $query->orderBy('businesses.' . $args['sort'], $order);
            }
        } else {
            $query->orderBy('businesses.name', 'asc');
        }
        $count = $query->distinct()->count('businesses.id');
        $query->select([
            'businesses.*',
            DB::raw('count(business_job_locations.job_id) as jobs_count'),
            DB::raw('count(distinct business_locations.id) as locations_count'),
        ])->groupBy('businesses.id')->orderBy('businesses.id');
        
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
