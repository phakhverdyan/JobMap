<?php

namespace App\GraphQL\Mutation\User\Resume\Distinction;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Distinction;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'Delete User Distinction'
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
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args)
    {
        $distinction = Distinction::where([
            'id' => $args['id'],
            'user_id' => $this->auth->id
        ]);
    
        if($distinction){
            if(!$distinction->delete()){
                return null;
            }
        }
        
        $data['token'] = $this->token;

        $user = User::find($this->auth->id);
        $user->updated_at = time();
        $user->save();
    
        return $data;
    }
}
