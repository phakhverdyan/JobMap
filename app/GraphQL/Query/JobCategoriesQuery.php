<?php

namespace App\GraphQL\Query;

use App\JobCategory;
use function foo\func;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\App;

class JobCategoriesQuery extends Query
{
    
    protected $attributes = [
        'name' => 'Job Categories by title'
    ];
    
    public function type()
    {
        return Type::listOf(GraphQL::type('Category'));
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'keywords' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Search by keywords'
            ],
            'locale' => [
                'type' => Type::string(),
                'description' => 'locale'
            ]
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public $idJobCategoryCustom = 20800;
    public function resolve($root, $args)
    {
        if (isset($args['locale'])) {
            App::setLocale($args['locale']);
        }

        $query = JobCategory::query();
        $query->where('parent_id', '=', null);
        
        $term = $args['keywords'];
        $terms = explode(" ", $args['keywords']);

        if (App::isLocale('fr')) {
            $query->whereIn('id', function ($q) use ($terms, $term) {
                $q->where('parent_id', '<>', null);
                $q->where(function($q) use ($terms, $term){
                    $q->orWhere('name_fr', 'like', '%' . $term . '%');
                    foreach ($terms as $item) {
                        $q->orWhere('name_fr', 'like', '%' . $item . '%');
                    }
                });
                $q->from('job_categories');
                $q->select('parent_id');
            });
        } else {
            $query->whereIn('id', function ($q) use ($terms, $term) {
                $q->where('parent_id', '<>', null);
                $q->where(function($q) use ($terms, $term){
                    $q->orWhere('name', 'like', '%' . $term . '%');
                    foreach ($terms as $item) {
                        $q->orWhere('name', 'like', '%' . $item . '%');
                    }
                });
                $q->from('job_categories');
                $q->select('parent_id');
            });
        }

        
        $data = $query->select(['id', 'parent_id', 'name', 'name_fr'])->get()->all();
        if (App::isLocale('fr')) {
            foreach ($data as $key=>$item) {
                $data[$key]->name = $item->name_fr;
            }
        }
        $data = collect($data)->sortBy('name')->toArray();
        
        return $data;
    }
}
