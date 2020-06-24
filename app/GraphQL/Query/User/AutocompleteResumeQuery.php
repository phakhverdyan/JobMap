<?php

namespace App\GraphQL\Query\User;

use App\Business;
use App\Certificate;
use App\Distinction;
use App\WorldLanguage;
use App\User\Resume\Autocomplete\Degree;
use App\User\Resume\Autocomplete\FieldOfStudy;
use App\User\Resume\Autocomplete\Grade;
use App\User\Resume\Autocomplete\Interest;
use App\User\Resume\Autocomplete\Skill;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\App;

class AutocompleteResumeQuery extends Query
{
    protected $attributes = [
        'name' => 'autocompleteResume'
    ];
    
    public function type()
    {
        return Type::listOf(GraphQL::type('AutocompleteResume'));
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'type' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'type autocomplete'
            ],
            'keywords' => [
                'type' => Type::string(),
                'description' => 'Keywords'
            ]
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public $countSkillsBasic = 196;
    public $countInterestsBasic = 306;
    public $countCertificatesBasic = 493;

    public function resolve($root, $args)
    {
        $data = [];

        switch ($args['type']) {
            case 'grade': {
                $query = Grade::query();

                if (isset($args['keywords'])) {
                    $query->where(function($query) use ($args) {
                        if (\App::getLocale() != 'en' && in_array(\App::getLocale(), ['fr'])) {
                            $query->orWhere('title_' . \App::getLocale(), 'like', '%' . $args['keywords'] . '%');
                        }

                        $query->orWhere('title', 'like', '%' . $args['keywords'] . '%');
                    });
                }

                if (in_array(\App::getLocale(), ['fr'])) {
                    $query->orderBy('title_' . \App::getLocale())->orderBy('title');
                }
                else {
                    $query->orderBy('title');
                }
                
                $data = $query->get();

                if (in_array(\App::getLocale(), ['fr'])) {
                    foreach ($data as $key => $item) {
                        $data[$key]->title = $item->{'title_' . \App::getLocale()};
                    }
                }

                $data = $data->toArray();
                break;
            }
            case 'degree': {
                $query = Degree::query();

                if (isset($args['keywords'])) {
                    $query->where(function($query) use ($args) {
                        if (\App::getLocale() != 'en' && in_array(\App::getLocale(), ['fr'])) {
                            $query->orWhere('title_' . \App::getLocale(), 'like', '%' . $args['keywords'] . '%');
                        }

                        $query->orWhere('title', 'like', '%' . $args['keywords'] . '%');
                    });
                }

                if (in_array(\App::getLocale(), ['fr'])) {
                    $query->orderBy('title_' . \App::getLocale())->orderBy('title');
                }
                else {
                    $query->orderBy('title');
                }

                $data = $query->limit(20)->get();

                if (in_array(\App::getLocale(), ['fr'])) {
                    foreach ($data as $key => $item) {
                        $data[$key]->title = $item->{'title_' . \App::getLocale()};
                    }
                }

                $data = $data->toArray();
                break;
            }
            case 'study': {
                $query = FieldOfStudy::query();
                
                if (isset($args['keywords'])) {
                    $query->where(function($query) use ($args) {
                        if (\App::getLocale() != 'en' && in_array(\App::getLocale(), ['fr'])) {
                            $query->orWhere('title_' . \App::getLocale(), 'like', '%' . $args['keywords'] . '%');
                        }

                        $query->orWhere('title', 'like', '%' . $args['keywords'] . '%');
                    });
                }

                if (in_array(\App::getLocale(), ['fr'])) {
                    $query->orderBy('title_' . \App::getLocale())->orderBy('title');
                }
                else {
                    $query->orderBy('title');
                }
                
                $data = $query->limit(20)->get();
                
                if (in_array(\App::getLocale(), ['fr'])) {
                    foreach ($data as $key => $item) {
                        $data[$key]->title = $item->{'title_' . \App::getLocale()};
                    }
                }

                $data = $data->toArray();
                break;
            }
            case 'company': {
                $query = Business::query();
                
                if (isset($args['keywords'])) {
                    $query->where(function($query) use ($args) {
                        if (\App::getLocale() != 'en' && in_array(\App::getLocale(), ['fr'])) {
                            $query->orWhere('name_' . \App::getLocale(), 'like', '%' . $args['keywords'] . '%');
                        }

                        $query->orWhere('name', 'like', '%' . $args['keywords'] . '%');
                    });
                }

                if (in_array(\App::getLocale(), ['fr'])) {
                    $query->orderBy('name_' . \App::getLocale())->orderBy('name');
                }
                else {
                    $query->orderBy('name');
                }
                
                $data = $query->limit(20)->get();

                if (in_array(\App::getLocale(), ['fr'])) {
                    foreach ($data as $key => $item) {
                        $data[$key]->title = $item->{'name_' . \App::getLocale()};
                    }
                }
                else {
                    foreach ($data as $key => $item) {
                        $data[$key]->title = $item->name;
                    }
                }

                $data = $data->toArray();
                break;
            }
            case 'skill': {
                $query = Skill::query();
                
                if (isset($args['keywords'])) {
                    $query->where(function($query) use ($args) {
                        if (\App::getLocale() != 'en' && in_array(\App::getLocale(), ['fr'])) {
                            $query->orWhere('title_' . \App::getLocale(), 'like', '%' . $args['keywords'] . '%');
                        }

                        $query->orWhere('title', 'like', '%' . $args['keywords'] . '%');
                    });
                }

                if (in_array(\App::getLocale(), ['fr'])) {
                    $query->orderBy('title_' . \App::getLocale())->orderBy('title');
                }
                else {
                    $query->orderBy('title');
                }
                
                $data = $query->limit(20)->get();
                
                if (in_array(\App::getLocale(), ['fr'])) {
                    foreach ($data as $key => $item) {
                        $data[$key]->title = $item->{'title_' . \App::getLocale()};
                    }
                }

                $data = $data->toArray();
                break;
            }
            case 'language': {
                $query = WorldLanguage::query();
                
                if (isset($args['keywords'])) {
                    $query->where('name', 'like', '%' . $args['keywords'] . '%');
                }

                $query->orderBy('name');
                $data = $query->limit(20)->get();
                
                foreach ($data as $key => $item) {
                    $data[$key]->title = $item->name;
                }

                $data = $data->toArray();
                break;
            }
            case 'certification': {
                $query = Certificate::query();
                
                if (isset($args['keywords'])) {
                    $query->where(function($query) use ($args) {
                        if (\App::getLocale() != 'en' && in_array(\App::getLocale(), ['fr'])) {
                            $query->orWhere('name_' . \App::getLocale(), 'like', '%' . $args['keywords'] . '%');
                        }

                        $query->orWhere('name', 'like', '%' . $args['keywords'] . '%');
                    });
                }

                if (in_array(\App::getLocale(), ['fr'])) {
                    $query->orderBy('name_' . \App::getLocale())->orderBy('name');
                }
                else {
                    $query->orderBy('name');
                }
                
                $data = $query->limit(20)->get();
                
                if (in_array(\App::getLocale(), ['fr'])) {
                    foreach ($data as $key => $item) {
                        $data[$key]->title = $item->{'name_' . \App::getLocale()};
                    }
                }
                else {
                    foreach ($data as $key => $item) {
                        $data[$key]->title = $item->name;
                    }
                }

                $data = $data->toArray();
                break;
            }
            case 'distinction': {
                $query = Distinction::query();
                
                if (isset($args['keywords'])) {
                    $query->where('name', 'like', '%' . $args['keywords'] . '%');
                }
                
                $data = $query->orderBy('name')->limit(20)->get();
                
                foreach ($data as $key => $item) {
                    $data[$key]->title = $item->name;
                }

                $data = $data->toArray();
                break;
            }
            case 'hobby': {
                $query = Interest::query();

                if (isset($args['keywords'])) {
                    $query->where(function($query) use ($args) {
                        if (\App::getLocale() != 'en' && in_array(\App::getLocale(), ['fr'])) {
                            $query->orWhere('title_' . \App::getLocale(), 'like', '%' . $args['keywords'] . '%');
                        }

                        $query->orWhere('title', 'like', '%' . $args['keywords'] . '%');
                    });
                }

                if (in_array(\App::getLocale(), ['fr'])) {
                    $query->orderBy('title_' . \App::getLocale())->orderBy('title');
                }
                else {
                    $query->orderBy('title');
                }

                $data = $query->limit(20)->get();

                if (in_array(\App::getLocale(), ['fr'])) {
                    foreach ($data as $key => $item) {
                        $data[$key]->title = $item->{'title_' . \App::getLocale()};
                    }
                }

                $data = $data->toArray();
                break;
            }
            case 'interest': {
                $query = Interest::query();

                if (isset($args['keywords'])) {
                    $query->where(function($query) use ($args) {
                        if (\App::getLocale() != 'en' && in_array(\App::getLocale(), ['fr'])) {
                            $query->orWhere('title_' . \App::getLocale(), 'like', '%' . $args['keywords'] . '%');
                        }

                        $query->orWhere('title', 'like', '%' . $args['keywords'] . '%');
                    });
                }

                if (in_array(\App::getLocale(), ['fr'])) {
                    $query->orderBy('title_' . \App::getLocale())->orderBy('title');
                }
                else {
                    $query->orderBy('title');
                }

                $data = $query->limit(20)->get();
                
                if (in_array(\App::getLocale(), ['fr'])) {
                    foreach ($data as $key => $item) {
                        $data[$key]->title = $item->{'title_' . \App::getLocale()};
                    }
                }

                $data = $data->toArray();
                break;
            }
            // case 'reference': {
            //     break;
            // }
            default: {
                $data = [];
                break;
            }
        }

        return $data;
    }
}
