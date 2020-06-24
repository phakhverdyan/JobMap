<?php

namespace App\GraphQL\Mutation\User\Resume\Experience;

use App\GraphQL\Auth;
use App\JobCategory;
use App\User;
use App\User\Resume\Experience;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\App;

class UpdateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'Update User Experience'
    ];
    
    public function type()
    {
        return GraphQL::type('UserExperience');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'id' => ['required', 'string'],
            'title' => ['required', 'string'],
            'company' => ['required', 'string'],
            'city' => ['required', 'string'],
            'date_from' => ['required', 'date'],
            'date_to' => ['required', 'date','greater_than_field:date_from']
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Experience ID'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'Title'
            ],
            'title_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Job title_id'
            ],
            'company' => [
                'type' => Type::string(),
                'description' => 'Company'
            ],
            'company_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Company id'
            ],
            'city' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Experience company City'
            ],
            'region' => [
                'type' => Type::string(),
                'description' => 'Experience company Region'
            ],
            'country' => [
                'type' => Type::string(),
                'description' => 'Experience company Country'
            ],
            'country_code' => [
                'type' => Type::string(),
                'description' => 'Experience company Country Code'
            ],
            'date_from' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Experience date from'
            ],
            'date_to' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Experience date to'
            ],
            'current' => [
                'type' => Type::int(),
                'description' => 'Experience work here'
            ],
            'industry_id' => [
                'type' => Type::int(),
                'description' => 'Experience industry'
            ],
            'sub_industry_id' => [
                'type' => Type::int(),
                'description' => 'Experience industry'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Experience Description'
            ],
            'additional_info' => [
                'type' => Type::string(),
                'description' => 'Experience additional info'
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
        $update = [];
        $fieldsFirstLetter = [
            'title',
            'company',
            'city',
            'description',
        ];

        if (!is_numeric($args['title_id'])) {
            $idNew = 0;
            if (App::isLocale('fr')) {
                if ($item = JobCategory::where('name_fr',$args['title_id'])->whereNull('parent_id')->first()) {
                    $idNew = $item->id;
                }
            } else {
                if ($item = JobCategory::where('name',$args['title_id'])->whereNull('parent_id')->first()) {
                    $idNew = $item->id;
                }
            }
            if ($idNew ==0) {
                $item = JobCategory::create([
                    'parent_id' => 20800,
                    'name' => $args['title_id'],
                    'name_fr' => $args['title_id']
                ]);
                $idNew = $item->id;
            }
            $args['title_id'] = $idNew;
        }
        if (!is_numeric($args['company_id'])) {
            $args['company_id'] = null;
        }

        foreach ($args as $field => $value) {
            if($field != 'id') {
                if (in_array($field,$fieldsFirstLetter)) {
                    $update[$field] = ucfirst($value);
                } else {
                    $update[$field] = $value;
                }
            }
        }
    
        $experience = Experience::where([
            'user_id' => $this->auth->id,
            'id' => $args['id']
        ])->update($update);
        
        if (!$experience) {
            return null;
        }
    
        $query = Experience::query();
        $query->where([
            'user_id' => $this->auth->id,
            'id' => $args['id']
        ]);
    
        $data = $query->first();
        $data['token'] = $this->token;

        $user = User::find($this->auth->id);
        $user->updated_at = $data['updated_at'];
        $user->save();
    
        return $data;
    }
}
