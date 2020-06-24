<?php

namespace App\GraphQL\Query\User\Business;

use App\Business\Job;
use App\Business\Location;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\App;
use App\GraphQL\OptionalAuth;

class MapJobQuery extends Query
{
    use OptionalAuth;

    protected $attributes = [
        'name' => 'Job'
    ];

    public function type()
    {
        return GraphQL::type('BusinessJob');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the job'
            ],
            'location_id' => [
                'type' => Type::id(),
                'description' => 'The id of the job location'
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
        $query = Job::query();
        $query->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id');
        $query->where('business_job_locations.id', $args['id']);
        //$query->where('business_jobs.id', $args['id']);

        $query->select([
            'business_jobs.*',
            'business_job_locations.id AS job_location_id',
            'business_job_locations.location_id AS location_id',
        ]);

        $data = $query->first();

        if (!$data) {
            return null;
        }

        // if (isset($args['location_id'])) {
        //     $query->where('business_job_locations.location_id', $args['location_id']);
        // }

        $location = Location::where('id', $data['location_id'])->first();

        $data['location'] = $location;
        $data['business'] = $location->business;

        $departments = [];
        foreach ($data['departments'] as $department) {
            $departments[] = $department['department'];
        }
        $data['assign_departments'] = $departments;

        $careers = [];
        foreach ($data['careerLevels'] as $career) {
            $careers[] = $career['careerLevel'];
        }
        $data['assign_career_levels'] = $careers;

        $types = [];
        foreach ($data['types'] as $type) {
            $types[] = $type['type'];
        }
        $data['assign_types'] = $types;

        $languages = [];
        foreach ($data['languages'] as $language) {
            $languages[] = $language['language'];
        }
        $data['assign_languages'] = $languages;

        $certificates = [];
        foreach ($data['certificates'] as $certificate) {
            $certificates[] = $certificate['certificate'];
        }
        $data['assign_certificates'] = $certificates;

        return $data;
    }
}
