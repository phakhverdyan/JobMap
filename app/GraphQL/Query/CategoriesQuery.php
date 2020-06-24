<?php

namespace App\GraphQL\Query;

use App\JobCategory;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\App;
use App\GraphQL\OptionalAuth;

class CategoriesQuery extends Query
{
    use OptionalAuth;

    protected $attributes = [
        'name' => 'Categories'
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
            'parent_id' => [
                'type' => Type::id(),
                'description' => 'Categories parent ids'
            ],
            'popular' => [
                'type' => Type::int(),
                'description' => 'Sub-Categories popular'
            ],
            'sub' => [
                'type' => Type::int(),
                'description' => 'Sub-Categories only'
            ],
            'default' => [
                'type' => Type::string(),
                'description' => 'Get default items'
            ],
            'keywords' => [
                'type' => Type::string(),
                'description' => 'Get items by keywords'
            ],
            'locale' => [
                'type' => Type::string(),
                'description' => 'locale'
            ],
            'language_prefix' => [
                'type' => Type::string(),
                'description' => 'Language prefix to search'
            ],
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
        $query = JobCategory::query();

        if (isset($args['parent_id'])) {
            $ids = explode(",", $args['parent_id']);
            $query->whereIn('parent_id', $ids);
        }
        else {
            if (isset($args['popular']) && $args['popular']) {
                $query->where('popular', '!=', 0);
                $query->orderBy('popular', 'desc');
                $query->limit(30);
            }

            if (isset($args['sub']) && $args['sub']) {
                $query->where('parent_id', '!=', null)->limit(30);
            }
            else {
                $query->where('parent_id', null);
            }
        }

        if (isset($args['default']) && ($args['default'] || $args['default'] == 'null')) {
            $query->whereIn('id', explode(',', $args['default']));
        }

        if (\App::isLocale('en')) {
            $query->where('name', '!=', '');
        }
        else {
            $query->where('name_' . \App::getLocale(), '!=', '');
        }
        
        if (isset($args['keywords'])) {
            if (\App::isLocale('en')) {
                $query->where('name', 'like', '%' . $args['keywords'] . '%');
            }
            else {
                $query->where('name_' . \App::getLocale(), 'like', '%' . $args['keywords'] . '%');
                // $query->where(function($query) use ($args) {
                //     $query->orWhere('name_' . \App::getLocale(), 'like', '%' . $args['keywords'] . '%');
                //     $query->orWhere('name', 'like', '%' . $args['keywords'] . '%');
                // });
            }
        }

        if (\App::getLocale('en')) {
            $query->orderBy('name');
        }
        else {
            $query->orderBy('name_' . \App::getLocale())->orderBy('name');
        }

        $categories = $query->get();
        return $categories;
    }
}
