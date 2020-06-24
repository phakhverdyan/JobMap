<?php

namespace App\GraphQL\Mutation\User\Resume\Education;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Autocomplete\Degree;
use App\User\Resume\Autocomplete\FieldOfStudy;
use App\User\Resume\Education;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\App;

class CreateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'New User Education'
    ];
    
    public function type()
    {
        return GraphQL::type('UserEducation');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'school_name' => ['required', 'string'],
            'city' => ['required', 'string'],
            'year_from' => ['required', 'numeric'],
            'year_to' => ['required', 'numeric','greater_than_field:year_from'],
            'degree' => ['required'],
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'school_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'School name'
            ],
            'city' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Education school City'
            ],
            'region' => [
                'type' => Type::string(),
                'description' => 'Education school Region'
            ],
            'country' => [
                'type' => Type::string(),
                'description' => 'Education school Country'
            ],
            'country_code' => [
                'type' => Type::string(),
                'description' => 'Education school Country Code'
            ],
            'year_from' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Education year from'
            ],
            'year_to' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Education year to'
            ],
            'grade' => [
                'type' => Type::string(),
                'description' => 'Education school Grade'
            ],
            'grade_id' => [
                'type' => Type::string(),
                'description' => 'Education school Grade id'
            ],
            'current' => [
                'type' => Type::int(),
                'description' => 'Currently study here'
            ],
            'degree' => [
                'type' => Type::string(),
                'description' => 'Education Degree'
            ],
            'degree_id' => [
                'type' => Type::string(),
                'description' => 'Education Degree id'
            ],
            'study' => [
                'type' => Type::string(),
                'description' => 'Education Field of study'
            ],
            'study_id' => [
                'type' => Type::string(),
                'description' => 'Education Field of study id'
            ],
            'activities' => [
                'type' => Type::string(),
                'description' => 'Education Activities and societies'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Education Description'
            ],
            'achievement_title' => [
                'type' => Type::string(),
                'description' => 'Education Achievement title'
            ],
            'achievement_description' => [
                'type' => Type::string(),
                'description' => 'Education Achievement description'
            ],
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args)
    {
        $fieldsFirstLetter = [
            'school_name',
            'city',
            'grade',
            'degree',
            'study',
            'activities',
            'description',
            'achievement_title',
            'achievement_description',
        ];

        if (isset($args['grade'])) {
            if (!isset($args['grade_id']) || (isset($args['grade_id']) && !is_numeric($args['grade_id']))) {
                $args['grade'] = null;
                $args['grade_id'] = null;
            }
        }
        if (isset($args['degree_id']) && !is_numeric($args['degree_id'])) {
            $idNew = 0;
            if (App::isLocale('fr')) {
                if ($item = Degree::where('title_fr',$args['degree_id'])->first()) {
                    $idNew = $item->id;
                }
            } else {
                if ($item = Degree::where('title',$args['degree_id'])->first()) {
                    $idNew = $item->id;
                }
            }
            if ($idNew ==0) {
                $item = Degree::create([
                    'title' => $args['degree_id'],
                    'title_fr' => $args['degree_id']
                ]);
                $idNew = $item->id;
            }
            $args['degree_id'] = $idNew;
        }
        if (isset($args['study_id']) && !is_numeric($args['study_id'])) {
            $idNew = 0;
            if (App::isLocale('fr')) {
                if ($item = FieldOfStudy::where('title_fr',$args['study_id'])->first()) {
                    $idNew = $item->id;
                }
            } else {
                if ($item = FieldOfStudy::where('title',$args['study_id'])->first()) {
                    $idNew = $item->id;
                }
            }
            if ($idNew ==0) {
                $item = FieldOfStudy::create([
                    'title' => $args['study_id'],
                    'title_fr' => $args['study_id']
                ]);
                $idNew = $item->id;
            }
            $args['study_id'] = $idNew;
        }

        $education = new Education;
        $education->user_id = $this->auth->id;
        
        foreach ($args as $k => $v) {
            if (in_array($v, $fieldsFirstLetter)) {
                $education->{$k} = ucfirst($v);
            } else {
                $education->{$k} = $v;
            }

        }

        $education->save();
        $education->token = $this->token;

        $user = User::find($this->auth->id);
        $user->recalculateResumeIsCompleted();
        $user->updated_at = $education->updated_at;
        $user->save();
        
        return $education;
    }
}
