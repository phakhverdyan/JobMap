<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Business\Administrator;
use App\Business\ManagerLocation;
use App\Business\Pipeline;
use App\Candidate\Candidate;
use App\GraphQL\Extensions\AuthQuery;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class CandidatesQuery extends AuthQuery
{
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Candidates'
    ];

    public function type()
    {
        return GraphQL::type('Candidates');
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
            ],
            'keywords' => [
                'type' => Type::string(),
                'description' => 'Search candidates by keywords'
            ],
            'filters' => [
                'type' => Type::string(),
                'description' => 'Search candidates by filters'
            ],
            'filtering_location_ids' => [
                'type' => Type::listOf(Type::int()),
            ],
            'filtering_job_ids' => [
                'type' => Type::listOf(Type::int()),
            ],
            'filtering_manager_ids' => [
                'type' => Type::listOf(Type::int()),
            ],
            'filtering_city_region' => [
                'type' => Type::listOf(Type::string()),
            ],
            'p' => [
                'type' => Type::string(),
                'description' => 'Search candidates by pipeline'
            ],
            'm' => [
                'type' => Type::int(),
                'description' => 'All candidates by auth location'
            ],
            'only_waves' => [
                'type' => Type::int(),
                'description' => 'Show only candidates with wave'
            ],
            'sort' => [
                'type' => Type::string(),
                'description' => 'Set field for order'
            ],
            'order' => [
                'type' => Type::string(),
                'description' => 'Set order'
            ],
            'looking_job' => [
                'type' => Type::string(),
                'description' => 'Set order'
            ],
            'its_urgent' => [
                'type' => Type::string(),
                'description' => 'Set order'
            ],
            'new_job' => [
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
        //set authorized roles
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::FRANCHISE_ROLE,
            Administrator::BRANCH_ROLE
        ];
        //set permissions for this object
        /*$this->permissions = [
            'view_candidates'
        ];*/
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();

        $myLocations = get_my_locations($args['business_id']);
        $managerRole = get_manager_role($args['business_id']);

        // if (!isset($args['m']) || (isset($args['m']) && $args['m'] == 1)) {
        //     $administrator = Administrator::where([
        //         'business_id' => $args['business_id'],
        //         'user_id' => auth()->user()->id
        //     ])->first();

        //     if ($administrator['role'] != 'admin') {
        //         $myLocations = ManagerLocation::where([
        //             'administrator_id' => $administrator['id']
        //         ])->pluck('location_id')->toArray();

        //         if (count($myLocations) == 0) {
        //             return array(
        //                 'items' => [],
        //                 'pages' => 1,
        //                 'count' => 0,
        //                 'current_page' => 1,
        //                 'token' => $this->token
        //             );
        //         }
        //     }
        // }

        $query = Candidate::query()->join('users', 'users.id', '=', 'c.user_id');
        $query->join('user_preferences', 'user_preferences.user_id', '=', 'users.id');

        $query->where(function ($q) use ($args) {
            $st1 = false;
            $st2 = false;
            $st3 = false;

            if (isset($args['looking_job']) && $args['looking_job'] == 'yes') {
                $q->orWhere('looking_job', 'yes');
            }
            else {
                $st1 = true;
            }

            if (isset($args['its_urgent']) && $args['its_urgent'] == 'yes') {
                $q->orWhere('its_urgent', 'yes');
            }
            else {
                $st2 = true;
            }

            if (isset($args['new_job']) && $args['new_job'] == 'yes') {
                $q->orWhere('new_job', 'yes');
            }
            else {
                $st3 = true;
            }

            // if ($st1 && $st2 && $st3) {
            //     $q->where('looking_job', 'a');
            // }
        });

        if (isset($args['filtering_location_ids']) && count($args['filtering_location_ids']) > 0) {
            $query->whereIn('location_id', $args['filtering_location_ids']);
        }

        if (isset($args['filtering_job_ids']) && count($args['filtering_job_ids']) > 0) {
            $query->whereIn('job_id', $args['filtering_job_ids']);
        }

        if (isset($args['filtering_manager_ids']) && count($args['filtering_manager_ids']) > 0) {
            $query->join('candidate_vieweds', 'candidate_vieweds.candidate_user_id', '=', 'users.id');
            $query->whereIn('manager_user_id', $args['filtering_manager_ids']);
        }

        if (isset($args['filtering_city_region']) && count($args['filtering_city_region']) > 0) {
            $values = $args['filtering_city_region'];
            $query->where(function ($query) use ($values) {
                foreach ($values as $value) {
                    $vals = explode("---", $value);
                    $query->orWhere(function ($query) use ($vals) {
                        if ($vals[1] == 'y' ) {
                            $vs = explode(",", $vals[0]);
                            if (count($vs) == 1) {
                                $query->where('users.region', 'like', '%' . trim($vs[0]) . '%');
                            }
                            if (count($vs) == 2) {
                                $query->where('users.region', 'like', '%' . trim($vs[0]) . '%');
                                $query->where('users.country', 'like', '%' . trim($vs[1]) . '%');
                            }
                            if (count($vs) > 2) {
                                $query->where('users.city', 'like', '%' . trim($vs[0]) . '%');
                                $query->where('users.region', 'like', '%' . trim($vs[1]) . '%');
                                $query->where('users.country', 'like', '%' . trim($vs[2]) . '%');
                            }
                        } else {
                            $query->orWhere('users.city', 'like', '%' . ucfirst(strtolower(trim($vals[0]))) . '%');
                            $query->orWhere('users.region', 'like', '%' . ucfirst(strtolower(trim($vals[0]))) . '%');
                            $query->orWhere('users.country', 'like', '%' . ucfirst(strtolower(trim($vals[0]))) . '%');
                        }
                    });
                }
            });
        }

        if (isset($args['keywords'])) {
            $value = $args['keywords'];
            $query->where(function ($query) use ($value) {
                $query->orWhere('users.first_name', 'like', '%' . $value . '%');
                $query->orWhere('users.last_name', 'like', '%' . $value . '%');
                $query->orWhere('users.city', 'like', '%' . $value . '%');
                $query->orWhere('users.region', 'like', '%' . $value . '%');
                $query->orWhere('users.country', 'like', '%' . $value . '%');
            });
        }
        if (isset($args['filters'])) {
            $cFilter = base64_decode($args['filters']);
            $query->join('user_preferences', 'user_preferences.user_id', '=', 'c.user_id');
            $f = explode('r_f:', $cFilter);
            $joinA = false;
            if (isset($f[0])) {
                $d = str_replace("_*_", "&", $f[0]);
                $filters = explode(';', $d);
                $availabilities = 1;
                $jobJoin = false;
                foreach ($filters as $k => $filter) {
                    $filterData = explode(':', $filter);

                    $filterName = $filterData[0];
                    $filterInfo = ($filterData[1]) ?? false;

                    switch ($filterName) {
                        case 'availabilities':
                            if ($filterInfo == 1) {
                                $query->join('user_availabilities', 'user_availabilities.user_id', '=', 'c.user_id');
                                $joinA = true;
                            } else {
                                if (!$jobJoin) {
                                    $jobJoin = true;
                                    $query->join('business_jobs', 'business_jobs.id', '=', 'c.job_id');
                                }
                            }
                            $availabilities = $filterInfo;
                            break;
                        case 'time1':
                            if ($availabilities == 1) {
                                $query->where('user_availabilities.time_1', $filterInfo);
                            } else {
                                $query->where('business_jobs.time_1', $filterInfo);
                            }
                            break;
                        case 'time2':
                            if ($availabilities == 1) {
                                $query->where('user_availabilities.time_2', $filterInfo);
                            } else {
                                $query->where('business_jobs.time_2', $filterInfo);
                            }
                            break;
                        case 'time3':
                            if ($availabilities == 1) {
                                $query->where('user_availabilities.time_3', $filterInfo);
                            } else {
                                $query->where('business_jobs.time_3', $filterInfo);
                            }
                            break;
                        case 'time4':
                            if ($availabilities == 1) {
                                $query->where('user_availabilities.time_4', $filterInfo);
                            } else {
                                $query->where('business_jobs.time_4', $filterInfo);
                            }
                            break;
                        case 'current_type':
                            $data = explode(',', $filterInfo);
                            $query->whereIn('user_preferences.current_type', $data);
                            break;
                        case 'looking_job':
                            $data = explode(',', $filterInfo);
                            $query->whereIn('user_preferences.looking_job', $data);
                            break;
                        case 'current_job':
                            $data = explode(',', $filterInfo);
                            $query->whereIn('user_preferences.current_job', $data);
                            break;
                        case 'interested_jobs':
                            $data = explode(',', $filterInfo);
                            $query->whereIn('user_preferences.interested_jobs', $data);
                            break;
                        case 'hours':
                            if (!$jobJoin) {
                                $jobJoin = true;
                                $query->join('business_jobs', 'business_jobs.id', '=', 'c.job_id');
                            }
                            $query->where('business_jobs.hours', $filterInfo);
                            break;
                        case 'categories':
                            if (!$jobJoin) {
                                $jobJoin = true;
                                $query->join('business_jobs', 'business_jobs.id', '=', 'c.job_id');
                            }
                            $categories = explode(",", $filterInfo);
                            $query->whereIn('business_jobs.categories', $categories);
                            break;
                        case 'title':
                            if (!$jobJoin) {
                                $jobJoin = true;
                                $query->join('business_jobs', 'business_jobs.id', '=', 'c.job_id');
                            }
                            $query->where('business_jobs.title', 'like', '%' . $filterInfo . '%');
                            break;
                        case 'types':
                            $query->join('business_job_types', 'business_job_types.job_id', '=', 'c.job_id');
                            $data = explode(',', $filterInfo);
                            $query->whereIn('business_job_types.type_id', $data);
                            break;
                        case 'languages':
                            $query->join('business_job_languages', 'business_job_languages.job_id', '=', 'c.job_id');
                            $data = explode(',', $filterInfo);
                            $query->whereIn('business_job_languages.world_language_id', $data);
                            break;
                        case 'certifications':
                            $query->join('business_job_certificates', 'business_job_certificates.job_id', '=', 'c.job_id');
                            $data = explode(',', $filterInfo);
                            $query->whereIn('business_job_certificates.certificate_id', $data);
                            break;
                        case 'departments':
                            $query->join('business_job_departments', 'business_job_departments.job_id', '=', 'c.job_id');
                            $data = explode(',', $filterInfo);
                            $query->whereIn('business_job_departments.department_id', $data);
                            break;
                        case 'location':
                            $query->join('business_locations', 'business_locations.id', '=', 'c.location_id');
                            $query->where(function ($query) use ($filterInfo) {
                                $query->orWhere('business_locations.city', 'like', '%' . $filterInfo . '%');
                                $query->orWhere('business_locations.region', 'like', '%' . $filterInfo . '%');
                                $query->orWhere('business_locations.country', 'like', '%' . $filterInfo . '%');
                                $query->orWhere('business_locations.street', 'like', '%' . $filterInfo . '%');
                            });
                            break;
                    }
                }
            }


            if (isset($f[1])) {
                $d = str_replace("_*_", "&", $f[1]);
                $rF = json_decode($d);
                if (isset($rF->p)) {
                    $filter = $rF->p;
                    if ($filter->new_job) {
                        $query->where('user_preferences.new_job', $filter->new_job);
                    }
                    if ($filter->new_opportunities) {
                        $query->where('user_preferences.new_opportunities', $filter->new_job);
                    }
                    if ($filter->distance) {
                        $query->where('user_preferences.distance', $filter->distance);
                        $query->where('user_preferences.distance_type', $filter->distance_type);
                    }
                    if ($filter->salary) {
                        $query->where('user_preferences.salary', $filter->salary);
                    }
                    if ($filter->hours_from) {
                        $query->where('user_preferences.hours_from', '>=', $filter->hours_from);
                    }
                    if ($filter->hours_to) {
                        $query->where('user_preferences.hours_to', '<=', $filter->hours_to);
                    }
                    if ($filter->industries) {
                        $arr = $filter->industries;
                        foreach ($arr as $ar) {
                            $ar = (array)$ar;
                            $query->where(function ($query) use ($ar) {
                                $query->orWhere('user_preferences.industries', 'like', $ar['id'] . ',%');
                                $query->orWhere('user_preferences.industries', 'like', '%,' . $ar['id'] . ',%');
                                $query->orWhere('user_preferences.industries', 'like', '%,' . $ar['id']);
                                $query->orWhere('user_preferences.industries', '=', $ar['id']);
                            });
                        }
                    }
                    if ($filter->sub_industries) {
                        $arr = $filter->sub_industries;
                        foreach ($arr as $ar) {
                            $ar = (array)$ar;
                            $query->where(function ($query) use ($ar) {
                                $query->orWhere('user_preferences.sub_industries', 'like', $ar['id'] . ',%');
                                $query->orWhere('user_preferences.sub_industries', 'like', '%,' . $ar['id'] . ',%');
                                $query->orWhere('user_preferences.sub_industries', 'like', '%,' . $ar['id']);
                                $query->orWhere('user_preferences.sub_industries', '=', $ar['id']);
                            });
                        }
                    }
                }
                if (isset($rF->a)) {
                    $filter = $rF->a;
                    if (!$joinA) {
                        $query->join('user_availabilities', 'user_availabilities.user_id', '=', 'c.user_id');
                    }
                    if ($filter->full_time) {
                        $query->where('user_availabilities.full_time', 1);
                    }
                    if ($filter->internship) {
                        $query->where('user_availabilities.internship', 1);
                    }
                    if ($filter->contractual) {
                        $query->where('user_availabilities.contractual', 1);
                    }
                    if ($filter->summer_positions) {
                        $query->where('user_availabilities.summer_positions', 1);
                    }
                    if ($filter->recruitment) {
                        $query->where('user_availabilities.recruitment', 1);
                    }
                    if ($filter->field_placement) {
                        $query->where('user_availabilities.field_placement', 1);
                    }
                    if ($filter->volunteer) {
                        $query->where('user_availabilities.volunteer', 1);
                    }
                }
                if (isset($rF->b)) {
                    $filter = $rF->b;
                    $query->join('user_basic_infos', 'user_basic_infos.user_id', '=', 'c.user_id');
                    if ($filter->headline) {
                        $terms = explode(' ', $filter->headline);
                        $text = $filter->headline;
                        $query->where(function ($query) use ($terms, $text) {
                            $query->orWhere('user_basic_infos.headline', 'like', '%' . $text . '%');
                            foreach ($terms as $term) {
                                $query->orWhere('user_basic_infos.headline', 'like', '%' . $term . '%');
                            }
                        });
                    }
                    if ($filter->location) {
                        $location = $filter->location;

                        $query->where(function ($query) use ($location) {
                            $query->orWhere('users.city', 'like', '%' . $location . '%');
                            $query->orWhere('users.region', 'like', '%' . $location . '%');
                            $query->orWhere('users.country', 'like', '%' . $location . '%');
                        });
                    }
                }
                if (isset($rF->e)) {
                    $filter = $rF->e;
                    $query->join('user_educations', 'user_educations.user_id', '=', 'c.user_id');
                    foreach ($filter as $data) {
                        if (!empty($data->school_name)) {
                            $terms = explode(' ', $data->school_name);
                            $text = $data->school_name;
                            $query->where(function ($query) use ($terms, $text) {
                                $query->orWhere('user_educations.school_name', 'like', '%' . $text . '%');
                                foreach ($terms as $term) {
                                    $query->orWhere('user_educations.school_name', 'like', '%' . $term . '%');
                                }
                            });
                        }
                        if (!empty($data->location)) {
                            $location = $data->location;
                            $query->where(function ($query) use ($location) {
                                $query->orWhere('user_educations.city', 'like', '%' . $location . '%');
                                $query->orWhere('user_educations.region', 'like', '%' . $location . '%');
                                $query->orWhere('user_educations.country', 'like', '%' . $location . '%');
                            });
                        }
                        if (!empty($data->year_from)) {
                            $query->where('user_educations.year_from', '>=', $data->year_from);
                        }
                        if (!empty($data->year_to)) {
                            $query->where('user_educations.year_to', '<=', $data->year_to);
                        }
                        if (!empty($data->grade)) {
                            $query->where('user_educations.grade', $data->grade);
                        }
                    }
                }
                if (isset($rF->ex)) {
                    $filter = $rF->ex;
                    $query->join('user_experiences', 'user_experiences.user_id', '=', 'c.user_id');
                    $i = [];
                    $s = [];
                    foreach ($filter as $data) {
                        if (!empty($data->title)) {
                            $terms = explode(' ', $data->title);
                            $text = $data->title;
                            $query->where(function ($query) use ($terms, $text) {
                                $query->orWhere('user_experiences.title', 'like', '%' . $text . '%');
                                foreach ($terms as $term) {
                                    $query->orWhere('user_experiences.title', 'like', '%' . $term . '%');
                                }
                            });
                        }
                        if (!empty($data->company)) {
                            $terms = explode(' ', $data->company);
                            $text = $data->company;
                            $query->where(function ($query) use ($terms, $text) {
                                $query->orWhere('user_experiences.company', 'like', '%' . $text . '%');
                                foreach ($terms as $term) {
                                    $query->orWhere('user_experiences.company', 'like', '%' . $term . '%');
                                }
                            });
                        }
                        if (!empty($data->location)) {
                            $location = $data->location;
                            $query->where(function ($query) use ($location) {
                                $query->orWhere('user_experiences.city', 'like', '%' . $location . '%');
                                $query->orWhere('user_experiences.region', 'like', '%' . $location . '%');
                                $query->orWhere('user_experiences.country', 'like', '%' . $location . '%');
                            });
                        }
                        if (!empty($data->date_from)) {
                            $query->where('user_experiences.date_from', '>=', $data->date_from);
                        }
                        if (!empty($data->date_to)) {
                            $query->where('user_experiences.date_to', '<=', $data->date_to);
                        }
                        if ($data->industries) {
                            $arr = $data->industries;
                            foreach ($arr as $ar) {
                                list('id' => $i[]) = (array)$ar;
                            }
                        }
                        if ($data->sub_industries) {
                            $arr = $data->sub_industries;
                            foreach ($arr as $ar) {
                                list('id' => $s[]) = (array)$ar;
                            }
                        }
                    }
                    if (count($i) > 0) {
                        $query->whereIn('user_experiences.industry_id', $i);
                    }
                    if (count($s) > 0) {
                        $query->whereIn('user_experiences.sub_industry_id', $s);
                    }
                }
                if (isset($rF->s)) {
                    $filter = $rF->s;
                    $query->join('user_skills', 'user_skills.user_id', '=', 'c.user_id');
                    foreach ($filter as $data) {
                        if ($data->title) {
                            $terms = explode(' ', $data->title);
                            $text = $data->title;
                            $query->where(function ($query) use ($terms, $text) {
                                $query->orWhere('user_skills.title', 'like', '%' . $text . '%');
                                foreach ($terms as $term) {
                                    $query->orWhere('user_skills.title', 'like', '%' . $term . '%');
                                }
                            });
                        }
                        if ($data->level) {
                            $query->where('user_skills.level', '<=', $data->level);
                        }
                    }
                }
                if (isset($rF->l)) {
                    $filter = $rF->l;
                    $query->join('user_languages', 'user_languages.user_id', '=', 'c.user_id');
                    foreach ($filter as $data) {
                        if ($data->title) {
                            $terms = explode(' ', $data->title);
                            $text = $data->title;
                            $query->where(function ($query) use ($terms, $text) {
                                $query->orWhere('user_languages.title', 'like', '%' . $text . '%');
                                foreach ($terms as $term) {
                                    $query->orWhere('user_languages.title', 'like', '%' . $term . '%');
                                }
                            });
                        }
                        if ($data->level) {
                            $query->where('user_languages.level', '<=', $data->level);
                        }
                    }
                }
                if (isset($rF->c)) {
                    $filter = $rF->c;
                    $query->join('user_certifications', 'user_certifications.user_id', '=', 'c.user_id');
                    foreach ($filter as $data) {
                        if ($data->title) {
                            $terms = explode(' ', $data->title);
                            $text = $data->title;
                            $query->where(function ($query) use ($terms, $text) {
                                $query->orWhere('user_certifications.title', 'like', '%' . $text . '%');
                                foreach ($terms as $term) {
                                    $query->orWhere('user_certifications.title', 'like', '%' . $term . '%');
                                }
                            });
                        }
                        if ($data->type) {
                            $query->where('user_certifications.type', '<=', $data->type);
                        }
                        if ($data->year) {
                            $query->where('user_certifications.year', '<=', $data->year);
                        }
                    }
                }
                if (isset($rF->d)) {
                    $filter = $rF->d;
                    $query->join('user_distinctions', 'user_distinctions.user_id', '=', 'c.user_id');
                    foreach ($filter as $data) {
                        if ($data->title) {
                            $terms = explode(' ', $data->title);
                            $text = $data->title;
                            $query->where(function ($query) use ($terms, $text) {
                                $query->orWhere('user_distinctions.title', 'like', '%' . $text . '%');
                                foreach ($terms as $term) {
                                    $query->orWhere('user_distinctions.title', 'like', '%' . $term . '%');
                                }
                            });
                        }
                        if ($data->year) {
                            $query->where('user_distinctions.year', '<=', $data->year);
                        }
                    }
                }
                if (isset($rF->h)) {
                    $filter = $rF->h;
                    $query->join('user_hobbies', 'user_hobbies.user_id', '=', 'c.user_id');
                    foreach ($filter as $data) {
                        if ($data->title) {
                            $terms = explode(' ', $data->title);
                            $text = $data->title;
                            $query->where(function ($query) use ($terms, $text) {
                                $query->orWhere('user_hobbies.title', 'like', '%' . $text . '%');
                                foreach ($terms as $term) {
                                    $query->orWhere('user_hobbies.title', 'like', '%' . $term . '%');
                                }
                            });
                        }
                    }
                }
                if (isset($rF->i)) {
                    $filter = $rF->i;
                    $query->join('user_interests', 'user_interests.user_id', '=', 'c.user_id');
                    foreach ($filter as $data) {
                        if ($data->title) {
                            $terms = explode(' ', $data->title);
                            $text = $data->title;
                            $query->where(function ($query) use ($terms, $text) {
                                $query->orWhere('user_interests.title', 'like', '%' . $text . '%');
                                foreach ($terms as $term) {
                                    $query->orWhere('user_interests.title', 'like', '%' . $term . '%');
                                }
                            });
                        }
                    }
                }
                if (isset($rF->r)) {
                    $filter = $rF->r;
                    $query->join('user_references', 'user_references.user_id', '=', 'c.user_id');
                    foreach ($filter as $data) {
                        if (!empty($data->title)) {
                            $terms = explode(' ', $data->title);
                            $text = $data->title;
                            $query->where(function ($query) use ($terms, $text) {
                                $query->orWhere('user_references.full_name', 'like', '%' . $text . '%');
                                foreach ($terms as $term) {
                                    $query->orWhere('user_references.full_name', 'like', '%' . $term . '%');
                                }
                            });
                        }
                        if (!empty($data->company)) {
                            $terms = explode(' ', $data->company);
                            $text = $data->company;
                            $query->where(function ($query) use ($terms, $text) {
                                $query->orWhere('user_references.company', 'like', '%' . $text . '%');
                                foreach ($terms as $term) {
                                    $query->orWhere('user_references.company', 'like', '%' . $term . '%');
                                }
                            });
                        }
                    }
                }
            }

        }
        if (isset($args['p'])) {
            $pipeline_query = Pipeline::query();
            $pipeline_query->where('business_id', $this->businessID);

            $pipeline_query->where(function($query) use ($args) {
                $query->orWhere('id', $args['p']);
                $query->orWhere('type', $args['p']);
                $query->orWhere('type_new', $args['p']);
            });

            $pipeline = $pipeline_query->first();

            $query->where(function($where) use ($pipeline) {
                $where->orWhere('c.pipeline', $pipeline->id);
                $where->orWhere('c.pipeline', $pipeline->type);
                $where->orWhere('c.pipeline', $pipeline->type_new);
            });
        }

        if (isset($args['sort'])) {
            $order = $args['order'] ?? 'asc';
            if ($args['sort'] == 'updated_date') {
                $query->orderBy('c.updated_at', $order);
            } else if ($args['sort'] == 'name') {
                $query->orderBy('users.first_name', $order);
            } else {
                $query->orderBy($args['sort'], $order);
            }
        } else {
            $query->orderBy('c.updated_at', 'desc');
        }



        $limit = $args['limit'] ?? 25;
        $page = $args['page'] ?? 1;
        $skip = ($page - 1) * $limit;
        $query->where('c.business_id', $args['business_id']);

        $query->select([
            'c.user_id as user_id',
            'c.id as id',
            'c.*',
        ])->distinct();
        $query->from(DB::raw('candidates c'));

        if ($managerRole != 'admin') {
            $query->whereIn('c.location_id', $myLocations);
        }

        $count = (clone $query)->distinct()->count('c.user_id');
        $wave_count_query = (clone $query);
        $wave_count_query->join('candidate_waves', 'c.last_wave_id', '=', 'candidate_waves.id');
        $wave_count_query->whereRaw('UNIX_TIMESTAMP(candidate_waves.created_at) + 86400 * 30 > UNIX_TIMESTAMP()');
        $wave_count = $wave_count_query->distinct()->count();

        if (isset($args['only_waves']) && $args['only_waves']) {
            $query->join('candidate_waves', 'c.last_wave_id', '=', 'candidate_waves.id');
            $query->whereRaw('UNIX_TIMESTAMP(candidate_waves.created_at) + 86400 * 30 > UNIX_TIMESTAMP()');
        }

        $sub_query = '(';
        $sub_query .= 'SELECT max(id) FROM candidates WHERE user_id = c.user_id and business_id = ' . $args['business_id'];

//        if (isset($args['filtering_location_ids']) && count($args['filtering_location_ids']) > 0) {
//            $sub_query .= ' AND location_id IN (' . implode(', ', $args['filtering_location_ids']) . ')';
//        }
//
//        if (isset($args['filtering_job_ids']) && count($args['filtering_job_ids']) > 0) {
//            $sub_query .= ' AND job_id IN (' . implode(', ', $args['filtering_job_ids']) . ')';
//        }

        $sub_query .= ')';

        $query->having(DB::raw('c.id'), '=', DB::raw($sub_query));


        $query->take($limit)->skip($skip);

        $data = $query->get();

        if (isset($args['locale'])) {
            App::setLocale($args['locale']);
        }

        return array(
            'items' => $data,
            'pages' => ceil($count / $limit),
            'count' => $count,
            'wave_count' => $wave_count,
            'current_page' => $page,
            'query' => $query->toSql(),
            'token' => $this->token
        );
    }
}
