<?php

namespace App\GraphQL\Query\User\Business;

use App\Business\Job;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\App;
use App\GraphQL\OptionalAuth;

class JobQuery extends Query
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
//            'business_id' => [
//                'type' => Type::nonNull(Type::id()),
//                'description' => 'The id of the business'
//            ]
            'locale' => [
                'type' => Type::string(),
                'description' => 'The output content language prefix',
            ],
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public $idCertificateCustom = 494;

    public function resolve($root, $args)
    {
        $query = Job::query();
        $query->where('id', $args['id']);
        $data = $query->first();
    
        if (!$data) {
            $data['id'] = null;
            $data['html'] = '';
        }
    
        $keywords = [];
        foreach ($data['keywords'] as $keyword) {
            $keywords[] = $keyword['keyword'];
        }
        $data['keywords'] = $keywords;

        $keywords_fr = [];
        foreach ($data['keywords_fr'] as $keyword) {
            $keywords_fr[] = $keyword['keyword'];
        }
        $data['keywords_fr'] = $keywords_fr;
        
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
        // dd(\App::getLocale());
        // if (App::isLocale('fr')) {
        //     foreach ($certificates as $key=>$item) {
        //         $certificates[$key]->name = $item->name_fr;
        //     }
        // }
        $certificates = collect($certificates)->sortBy('name')->toArray();

        $data['assign_certificates'] = $certificates;

        return $data;
    }
}
