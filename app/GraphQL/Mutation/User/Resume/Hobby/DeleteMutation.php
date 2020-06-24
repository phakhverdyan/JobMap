<?php

namespace App\GraphQL\Mutation\User\Resume\Hobby;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Hobby;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'Delete User Hobby'
    ];
    
    public function type()
    {
        return GraphQL::type('UserHobby');
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
                'description' => 'Hobby ID'
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
        $hobby = Hobby::where([
            'id' => $args['id'],
            'user_id' => $this->auth->id
        ]);
    
        if($hobby){
            if(!$hobby->delete()){
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
