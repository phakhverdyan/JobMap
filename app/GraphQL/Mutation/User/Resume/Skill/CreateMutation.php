<?php

namespace App\GraphQL\Mutation\User\Resume\Skill;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Skill;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\App;

class CreateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'New User Skill'
    ];
    
    public function type()
    {
        return GraphQL::type('UserSkill');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'level' => ['required', 'regex:/(^([0-9]+)?$)/u']
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
                'description' => 'Skill title'
            ],
            'title_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Job title_id'
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Skill description'
            ],
            'level' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Skill level'
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
            'description',
        ];

        if (!is_numeric($args['title_id'])) {
            $idNew = 0;
            if (App::isLocale('fr')) {
                if ($item = User\Resume\Autocomplete\Skill::where('title_fr',$args['title_id'])->first()) {
                    $idNew = $item->id;
                }
            } else {
                if ($item = User\Resume\Autocomplete\Skill::where('title',$args['title_id'])->first()) {
                    $idNew = $item->id;
                }
            }
            if ($idNew ==0) {
                $item = User\Resume\Autocomplete\Skill::create([
                    'title' => $args['title_id'],
                    'title_fr' => $args['title_id']
                ]);
                $idNew = $item->id;
            }
            $args['title_id'] = $idNew;
        }

        $skill = new Skill;
        $skill->user_id = $this->auth->id;

        foreach ($args as $k => $v){
            if (in_array($v, $fieldsFirstLetter)) {
                $skill->{$k} = ucfirst($v);
            } else {
                $skill->{$k} = $v;
            }
        }
    
        $skill->save();
        $skill->token = $this->token;

        $user = User::where('id', $this->auth->id)->first();
        $user->recalculateResumeIsCompleted();
        $user->updated_at = $skill->updated_at;
        $user->save();
        
        return $skill;
    }
}
