<?php

namespace App\GraphQL\Query;

use App\Business;
use App\JobCategory;
use App\Keyword;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\App;

class GetDataSearchQuery extends Query
{
    
    protected $attributes = [
        'name' => 'getDataSearch'
    ];
    
    public function type()
    {
        return Type::listOf(GraphQL::type('GetDataSearch'));
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'key' => [
                'type' => Type::string(),
                'description' => 'Keywords'
            ],
            'locale' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'locale'
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
        if (!isset($args['key'])) {
            return null;
        }
        App::setLocale($args['locale']);
        if (App::isLocale('fr')) {
            $jobs = JobCategory::whereNotNull('parent_id')->where('name_fr','LIKE','%'.$args['key'].'%')->select('id','name_fr as name')->limit(5)->get();
        } else {
            $jobs = JobCategory::whereNotNull('parent_id')->where('name','LIKE','%'.$args['key'].'%')->select('id','name')->limit(5)->get();
        }

        $companies = Business::where('name','LIKE','%'.$args['key'].'%')->select('id','name')->limit(5)->get();
        $keywords = Keyword::where('name','LIKE','%'.$args['key'].'%')->select('id','name')->limit(5)->get();

        $response = [];
        foreach ($companies as $company) {
            $response[] = [
                'id' => 'c_' . $company->id,
                'title' => $company->name
            ];
        }
        foreach ($jobs as $job) {
            $response[] = [
                'id' => 'j_' . $job->id,
                'title' => $job->name
            ];
        }
        foreach ($keywords as $keyword) {
            $response[] = [
                'id' => 'k_' . $keyword->id,
                'title' => $keyword->name
            ];
        }

        return $response;
    }
}
