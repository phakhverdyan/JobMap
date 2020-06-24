<?php

namespace App\GraphQL\Mutation\User\Resume\Interest;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Interest;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'Delete User Interest'
    ];
    
    public function type()
    {
        return GraphQL::type('UserInterest');
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
                'description' => 'Interest ID'
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
        $interest = Interest::where([
            'id' => $args['id'],
            'user_id' => $this->auth->id
        ])->first();
    
        if ($interest) {
            $interest->delete();
        }
        
        $user = User::find($this->auth->id);
        $user->recalculateResumeIsCompleted();
        $user->updated_at = time();
        $user->save();
    
        $data = [];
        $data->token = $this->token;
        return $data;
    }
}
