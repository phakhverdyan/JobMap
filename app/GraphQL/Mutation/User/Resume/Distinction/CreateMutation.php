<?php

namespace App\GraphQL\Mutation\User\Resume\Distinction;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Distinction;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class CreateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'New User Distinction'
    ];
    
    public function type()
    {
        return GraphQL::type('UserDistinction');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'title' => ['required', 'string'],
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
                'description' => 'Distinction title'
            ],
            'title_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Job title_id'
            ],
            'year' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Distinction year'
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
            if ($jc = \App\Distinction::where('name',$args['title_id'])->first()) {
                $idNew = $jc->id;
            } else {
                $item = \App\Distinction::create([
                    'name' => $args['title_id']
                ]);
                $idNew = $item->id;
            }
            $args['title_id'] = $idNew;
        }

        $distinction = new Distinction();
        $distinction->user_id = $this->auth->id;
        foreach ($args as $k => $v){
            if (in_array($v, $fieldsFirstLetter)) {
                $distinction->{$k} = ucfirst($v);
            } else {
                $distinction->{$k} = $v;
            }
        }
    
        $distinction->save();
        if (!$distinction) {
            return null;
        }
    
        $distinction['token'] = $this->token;

        $user = User::find($this->auth->id);
        $user->updated_at = $distinction->updated_at;
        $user->save();
        
        return $distinction;
    }
}
