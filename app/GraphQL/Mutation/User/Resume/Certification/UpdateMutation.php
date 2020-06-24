<?php

namespace App\GraphQL\Mutation\User\Resume\Certification;

use App\Certificate;
use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Certification;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\App;

class UpdateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'Update User Certification'
    ];
    
    public function type()
    {
        return GraphQL::type('UserCertification');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'id' => ['required', 'string'],
            'title' => ['required', 'string'],
            'type' => ['required', 'string'],
            'year' => ['required', 'numeric']
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
                'description' => 'Certification ID'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'Certification title'
            ],
            'title_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Job title_id'
            ],
            'type' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Certification type'
            ],
            'year' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Certification year'
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
        $update = [];
        $fieldsFirstLetter = [
            'title',
        ];

        if (!is_numeric($args['title_id'])) {
            $idNew = 0;
            if (App::isLocale('fr')) {
                if ($jc = Certificate::where('name_fr',$args['title_id'])->first()) {
                    $idNew = $jc->id;
                }
            } else {
                if ($jc = Certificate::where('name',$args['title_id'])->first()) {
                    $idNew = $jc->id;
                }
            }
            if ($idNew ==0) {
                $newJC = Certificate::create([
                    'name' => $args['title_id'],
                    'name_fr' => $args['title_id']
                ]);
                $idNew = $newJC->id;
            }
            $args['title_id'] = $idNew;
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
    
        $certification = Certification::where([
            'user_id' => $this->auth->id,
            'id' => $args['id']
        ])->update($update);
        
        if (!$certification) {
            return null;
        }
    
        $query = Certification::query();
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
