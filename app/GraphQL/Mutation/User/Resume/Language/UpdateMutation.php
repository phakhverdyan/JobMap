<?php

namespace App\GraphQL\Mutation\User\Resume\Language;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Language;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'Update User Language'
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
            'id' => ['required', 'string'],
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
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Language ID'
            ],
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
        $update = [];
        $fieldsFirstLetter = [
            'title',
        ];

        if (isset($args['title'])) {
            if (!isset($args['title_id']) || (isset($args['title_id']) && !is_numeric($args['title_id']))) {
                $args['title'] = null;
                $args['title_id'] = null;
            }
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
    
        $language = Language::where([
            'user_id' => $this->auth->id,
            'id' => $args['id']
        ])->update($update);
        
        if (!$language) {
            return null;
        }
    
        $query = Language::query();
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
