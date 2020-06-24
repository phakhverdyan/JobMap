<?php

namespace App\GraphQL\Mutation\User\Resume\Distinction;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Distinction;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'Update User Distinction'
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
            'id' => ['required', 'string'],
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
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Distinction ID'
            ],
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
        $update = [];
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

        foreach ($args as $field => $value) {
            if($field != 'id') {
                if (in_array($field,$fieldsFirstLetter)) {
                    $update[$field] = ucfirst($value);
                } else {
                    $update[$field] = $value;
                }
            }
        }
    
        $distinction = Distinction::where([
            'user_id' => $this->auth->id,
            'id' => $args['id']
        ])->update($update);
        
        if (!$distinction) {
            return null;
        }
    
        $query = Distinction::query();
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
