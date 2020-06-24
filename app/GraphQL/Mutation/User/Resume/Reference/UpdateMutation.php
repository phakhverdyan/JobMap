<?php

namespace App\GraphQL\Mutation\User\Resume\Reference;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Reference;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'Update User Reference'
    ];
    
    public function type()
    {
        return GraphQL::type('Reference');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'id' => ['required', 'integer'],
            'email' => ['required', 'string', 'email'],
            'phone' => ['required', 'string'],
            'full_name' => ['required', 'string', 'regex:/(^([a-z\sA-Z]+)?$)/u'],
            'company' => ['required', 'string']
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
                'description' => 'Reference ID'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'Email of referer'
            ],
            'phone' => [
                'type' => Type::string(),
                'description' => 'Phone number of referer'
            ],
            'full_name' => [
                'type' => Type::string(),
                'description' => 'Full name of referer'
            ],
            'company' => [
                'type' => Type::string(),
                'description' => 'Company of referer'
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
        foreach ($args as $field => $value) {
            if($field != 'id') {
                $update[$field] = $value;
            }
        }
    
        $reference = Reference::where([
            'user_id' => $this->auth->id,
            'id' => $args['id']
        ])->update($update);

        if (!$reference) {
            return null;
        }
    
        $query = Reference::query();
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
