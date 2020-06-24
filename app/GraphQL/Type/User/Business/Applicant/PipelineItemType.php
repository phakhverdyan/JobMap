<?php

namespace App\GraphQL\Type\User\Business\Applicant;

use App\Candidate\Candidate;
use App\GraphQL\Fields\Business\HtmlMapField;
use App\GraphQL\Fields\Business\HtmlMapListField;
use App\GraphQL\Fields\Business\PictureField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Facades\DB;
use App\Business\Administrator;
use App\Business\ManagerLocation;

class PipelineItemType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Pipeline item',
        'description' => 'Business pipeline item'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The id of the pipeline'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of pipeline En'
            ],
            'name_fr' => [
                'type' => Type::string(),
                'description' => 'The name of pipeline Fr'
            ],
            'localized_name' => [
                'type' => Type::string(),
                'description' => 'The name of pipeline (Localized)'
            ],
            'type' => [
                'type' => Type::string(),
                'description' => 'Pipeline type'
            ],
            'icon' => [
                'type' => Type::string(),
                'description' => 'Pipeline icon'
            ],
            'type_new' => [
                'type' => Type::string(),
                'description' => 'Pipeline type'
            ],
            'not_delete' => [
                'type' => Type::int(),
                'description' => 'Pipeline not_delete'
            ],
            'position' => [
                'type' => Type::int(),
                'description' => 'Pipeline position'
            ],
            'candidates' => [
                'type' => Type::int(),
                'description' => 'Count candidates',

                'args' => [
                    'looking_job'               => Type::string(),
                    'its_urgent'                => Type::string(),
                    'new_job'                   => Type::string(),
                    'filtering_job_ids'         => Type::listOf(Type::int()),
                    'filtering_location_ids'    => Type::listOf(Type::int()),
                ],

                'resolve' => function($root, $args) {
                    $count_query = Candidate::join('users', 'users.id', '=', 'candidates.user_id');
                    $count_query->join('user_preferences', 'user_preferences.user_id', '=', 'users.id');

                    // Only by current auth locations
                    $myLocations = get_my_locations($root['business_id']);
                    $managerRole = get_manager_role($root['business_id']);
                    if ($managerRole != 'admin') {
                        $count_query->whereIn('candidates.location_id', $myLocations);
                    }

                    $count_query->where(function($q) use ($args) {
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
                        $count_query->whereIn('candidates.location_id', $args['filtering_location_ids']);
                    }

                    if (isset($args['filtering_job_ids']) && count($args['filtering_job_ids']) > 0) {
                        $count_query->whereIn('candidates.job_id', $args['filtering_job_ids']);
                    }

                    $data = $count_query->where([
                        'pipeline' => (!$root['type'] || $root['type'] == 'custom') ? $root['id'] : $root['type'],
                        'business_id' => $root['business_id'],
                    ])->distinct('candidates.user_id')->count('candidates.user_id');

                    return $data;
                }
            ],

            'waving_candidates' => [
                'type' => Type::int(),
                'description' => 'Count of waving candidates',

                'args' => [
                    'looking_job'   => Type::string(),
                    'its_urgent'    => Type::string(),
                    'new_job'       => Type::string(),
                    'filtering_job_ids'         => Type::listOf(Type::int()),
                    'filtering_location_ids'    => Type::listOf(Type::int()),
                ],

                'resolve' => function($root, $args) {
                    $count_query = Candidate::query();

                    $count_query = Candidate::join('users', 'users.id', '=', 'candidates.user_id');
                    $count_query->join('user_preferences', 'user_preferences.user_id', '=', 'users.id');

                    $count_query->where(function($q) use ($args) {
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
                        $count_query->whereIn('location_id', $args['filtering_location_ids']);
                    }

                    if (isset($args['filtering_job_ids']) && count($args['filtering_job_ids']) > 0) {
                        $count_query->whereIn('job_id', $args['filtering_job_ids']);
                    }

                    $count_query->join('candidate_waves', 'candidates.last_wave_id', '=', 'candidate_waves.id');
                    $count_query->where('candidates.last_wave_id', '>', 0);
                    $count_query->whereRaw('UNIX_TIMESTAMP(candidate_waves.created_at) + 86400 * 30 > UNIX_TIMESTAMP()');
                    $count_query->where('candidates.pipeline', ($root['type'] == 'custom') ? $root['id'] : $root['type']);
                    $count_query->where('candidates.business_id', $root['business_id']);
                    $data = $count_query->distinct('candidates.user_id')->count('candidates.user_id');

                    return $data;
                },
            ],

            'html' => \App\GraphQL\Fields\Business\Pipeline\HtmlField::class,

            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
        ];
    }
}
