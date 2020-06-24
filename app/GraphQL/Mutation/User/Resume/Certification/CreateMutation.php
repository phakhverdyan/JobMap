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

class CreateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'New User Certification'
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

        $certification = new Certification;
        $certification->user_id = $this->auth->id;

        foreach ($args as $k => $v){
            if (in_array($v, $fieldsFirstLetter)) {
                $certification->{$k} = ucfirst($v);
            } else {
                $certification->{$k} = $v;
            }
        }
    
        $certification->save();
        $certification->token = $this->token;

        $user = User::find($this->auth->id);
        $user->recalculateResumeIsCompleted();
        $user->updated_at = $certification->updated_at;
        $user->save();
        
        return $certification;
    }
}
