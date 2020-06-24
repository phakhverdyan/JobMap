<?php

namespace App\GraphQL\Type\User\Business;

use App\Candidate\Candidate;
use App\GraphQL\Fields\Business\Job\CareerHtmlField;
use App\GraphQL\Fields\Business\Job\CareerHtmlListField;
use App\GraphQL\Fields\Business\Job\HtmlField;
use App\JobCategory;
use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Facades\App;

class JobType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business Job',
        'description' => 'Business Job'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Job id'
            ],
            'business_locations__business_id' => [
                'type' => Type::id(),
                'description' => 'business_locations__business_id'
            ],
            'business__name' => [
                'type' => Type::string(),
                'description' => 'business__name'
            ],
            'business' => [
                'type' => \GraphQL::type('Business'),
                'resolve' => function ($root, $args) {
                    return ($root['business']) ?? null;
                }
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'Job title',
                'resolve' => function ($root, $args) {
                    if ($root['title_id']) {
                        $jobCat = JobCategory::find($root['title_id']);
                        return $jobCat->name;
                    }

                    return $root['title'];
                }
            ],
            'title_id' => [
                'type' => Type::int(),
                'description' => 'Job title ID',
            ],
            'title_fr' => [
                'type' => Type::string(),
                'description' => 'Job title',
                'resolve' => function ($root, $args) {
                    if ($root['title_fr_id']) {
                        $jobCat = JobCategory::find($root['title_fr_id']);
                        return $jobCat->name_fr;
                    }

                    return $root['title_fr'];
                }
            ],
            'localized_title' => [
                'type' => Type::string(),
                'description' => 'Localized job title',
            ],
            'title_fr_id' => [
                'type' => Type::int(),
                'description' => 'Job title FR ID',
            ],
            'assign_title' => [
                'type' =>\GraphQL::type('JobCategory'),
                'resolve' => function ($root, $args) {
                    if ($root['title_id']) {
                        $jobCat = JobCategory::find($root['title_id']);
                        $name = $jobCat->name;

                        return  [
                            'id' => $root['title_id'],
                            'name' => $name,
                        ];
                    }
                    return null;
                }
            ],
            'assign_title_fr' => [
                'type' =>\GraphQL::type('JobCategory'),
                'resolve' => function ($root, $args) {
                    if ($root['title_fr_id']) {
                        $jobCat = JobCategory::find($root['title_fr_id']);
                        $name = $jobCat->name_fr;

                        return  [
                            'id' => $root['title_fr_id'],
                            'name' => $name,
                        ];
                    }
                    return null;
                }
            ],
            'assign_category' => [
                'type' =>\GraphQL::type('JobCategory'),

                'resolve' => function ($root, $args) {
                    return JobCategory::find($root['category_id']);
                }
            ],
            'category_id' => [
                'type' => Type::int(),
                'description' => 'Job category'
            ],
            'category_name' => [
                'type' => Type::string(),
                'description' => 'Job category name',
                'resolve' => function ($root, $args) {
                    if ($root['category']) {
                        $lname = $root['category']['name'];
                        if (App::isLocale('fr')) {
                            $lname = $root['category']['name_fr'];
                        }
                        return $lname;
                    } else {
                        return '';
                    }
                }
            ],
            'salary' => [
                'type' => Type::string(),
                'description' => 'Job salary'
            ],
            'salary_type' => [
                'type' => Type::string(),
                'description' => 'Job salary type'
            ],
            'hours' => [
                'type' => Type::int(),
                'description' => 'Hours or Week'
            ],
            'type_key' => [
                'type' => Type::string(),
                'description' => 'Job Type Key'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Job description'
            ],
            'description_fr' => [
                'type' => Type::string(),
                'description' => 'Job description FR'
            ],
            'localized_description' => [
                'type' => Type::string(),
                'description' => 'Localized job description',
            ],
            'notes' => [
                'type' => Type::string(),
                'description' => 'Job special notes'
            ],
            'notes_fr' => [
                'type' => Type::string(),
                'description' => 'Job special notes FR'
            ],
            'localized_notes' => [
                'type' => Type::string(),
                'description' => 'Job special notes (localized)',
            ],
            'time_1' => [
                'type' => Type::string(),
                'description' => 'Available For Morning'
            ],
            'time_2' => [
                'type' => Type::string(),
                'description' => 'Available For Daytime'
            ],
            'time_3' => [
                'type' => Type::string(),
                'description' => 'Available For Evening'
            ],
            'time_4' => [
                'type' => Type::string(),
                'description' => 'Available For Night'
            ],
            'career_status' => [
                'type' => Type::string(),
                'description' => 'Career status for this job'
            ],
            'work_status' => [
                'type' => Type::string(),
                'description' => 'Work status for this job'
            ],
            'options' => [
                'type' => Type::string(),
                'description' => 'Options for this job'
            ],
            'status' => [
                'type' => Type::int(),
                'description' => 'Job status'
            ],
            'next_page' => [
                'type' => Type::int(),
                'description' => 'Next page'
            ],
            'status_in_location' => [
                'type' => Type::int(),
                'description' => 'Job status',
                'resolve' => function ($root, $args) {
                    foreach ($root['locationsAll'] as $location) {
                        if ($location['location_id'] == $root['location_id']) return $location['status'];
                    }
                }
            ],
            'created_date' => [
                'type' => Type::string(),
                'description' => 'Department created date',
                'resolve' => function ($root, $args) {
                    if (isset($root['created_at'])) {
                        return $root['created_at']->format('M d, Y');
                    } else {
                        return null;
                    }
                }
            ],
            'created_date_iso' => [
                'type' => Type::string(),
                'description' => 'Job created at date in ISO format',

                'resolve' => function ($root, $args) {
                    return $root['created_at']->format(\DateTime::ATOM);
                },
            ],
            'created_date_ago' => [
                'type' => Type::string(),
                'description' => 'date ago',
                'resolve' => function($root, $args){
                    $your_date = $root['created_at']->timestamp;
                    $datediff = time() - $your_date;
                    $days = round($datediff / (60*60*24));

                    Carbon::setLocale( App::getLocale());
                    $dt = Carbon::now();
                    $d = ($days == 0) ? trans('fields.today') : $dt->subDays($days)->diffForHumans();
                    return $d;
                }
            ],
            'assign_locations' => [
                'type' => Type::listOf(\GraphQL::type('BusinessLocation')),
                'resolve' => function ($root, $args) {
                    $locations = [];
                    $i = 0;
                    foreach ($root['locationsAll'] as $location) {
                        $locations[$i] = $location['location'];
                        $locations[$i]['job_status'] = $location['status'];
                        $locations[$i]['job_id'] = $location['id'];
                        ++$i;
                    }
                    return $locations;
                }
            ],
            'job_id' => [
                'type' => Type::int(),
                'resolve' => function ($root, $args) {
                    foreach ($root['locationsAll'] as $location) {
                        if ($location['location_id'] == $root['location_id']) return $location['id'];
                    }
                    return 0;
                }
            ],
            'job_location_id' => [
                'type' => Type::int(),
            ],
            'days_send_resume' => [
                'type' => Type::int(),
                'resolve' => function ($root, $args) {
                    $days = 0;
                    $where = [
                        'business_id' => $root['business_id'],
                        'user_id' => $root['login_user_id'],
                        'job_id' => $root['id']
                    ];
                    if ($candidate = Candidate::where($where)->first()) {
                        $now = time();
                        $date = date('Y-m-d H:i:s', strtotime('-' . config('services.send_resume_interval') . ' day', $now));
                        if ($candidate['updated_at'] < $date) {
                            $days = 0;
                        } else {
                            $your_date = strtotime($candidate['updated_at']);
                            $datediff = $now - $your_date;
                            $days = config('services.send_resume_interval') - round($datediff / (60 * 60 * 24));
                        }
                    }
                    return $days;
                }
            ],
            'location' => [
                'type' => \GraphQL::type('BusinessLocation'),
                'description' => 'Location for one job'
            ],
            'job_status' => [
                'type' => Type::int(),
                'description' => ''
            ],
            'keywords' => [
                'type' => Type::listOf(\GraphQL::type('Keyword'))
            ],
            'keywords_fr' => [
                'type' => Type::listOf(\GraphQL::type('Keyword'))
            ],
            'localized_keywords' => [
                'type' => Type::listOf(\GraphQL::type('Keyword')),
            ],
            'assign_departments' => [
                'type' => Type::listOf(\GraphQL::type('BusinessDepartment'))
            ],
            'assign_career_levels' => [
                'type' => Type::listOf(\GraphQL::type('CareerLevel'))
            ],
            'assign_types' => [
                'type' => Type::listOf(\GraphQL::type('JobType'))
            ],
            'assign_languages' => [
                'type' => Type::listOf(\GraphQL::type('WorldLanguage'))
            ],
            'assign_certificates' => [
                'type' => Type::listOf(\GraphQL::type('Certificate'))
            ],
            'html' => HtmlField::class,
            'html_career' => CareerHtmlField::class,
            'html_career_list' => CareerHtmlListField::class,
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
            'questions' => [
                'type' => Type::listOf(\GraphQL::type('JobQuestion')),
                'description' => 'questions for  job'
            ],
        ];
    }
}
