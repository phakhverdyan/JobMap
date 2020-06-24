<?php

namespace App\GraphQL\Mutation\User\Resume\Reference;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Reference;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'Delete User Reference'
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
                'description' => 'Reference ID'
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
        $reference = Reference::where('id', $args['id'])->where('user_id', $this->auth->id)->first();
    
        if ($reference) {
            $reference->delete();
        }
            
        $user = User::where('id', $this->auth->id)->first();
        $user->recalculateResumeIsCompleted();
        $user->updated_at = time();
        $user->save();
    
        $data = [];
        $data['token'] = $this->token;
        return $data;
    }
}
