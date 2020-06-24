<?php

namespace App\GraphQL\Mutation\User\Resume\Language;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Language;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class CreateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'New User Language'
    ];
    
    public function type()
    {
        return GraphQL::type('UserLanguage');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'title' => ['required', 'string'],
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
                'description' => 'Language title'
            ],
            'title_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Job title_id'
            ],
            'level' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Language level'
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

        if (isset($args['title'])) {
            if (!isset($args['title_id']) || (isset($args['title_id']) && !is_numeric($args['title_id']))) {
                $args['title'] = null;
                $args['title_id'] = null;
            }
        }

        $language = new Language();
        $language->user_id = $this->auth->id;
        foreach ($args as $k => $v){
            if (in_array($v, $fieldsFirstLetter)) {
                $language->{$k} = ucfirst($v);
            } else {
                $language->{$k} = $v;
            }
        }
    
        $language->save();
        if (!$language) {
            return null;
        }
    
        $language['token'] = $this->token;

        $user = User::find($this->auth->id);
        $user->updated_at = $language->updated_at;
        $user->save();
        
        return $language;
    }
}
