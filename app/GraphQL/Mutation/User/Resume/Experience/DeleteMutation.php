<?php

namespace App\GraphQL\Mutation\User\Resume\Experience;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Experience;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'Delete User Experience'
    ];
    
    public function type()
    {
        return GraphQL::type('UserExperience');
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
                'description' => 'Experience ID'
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
        $experience = Experience::where([
            'id' => $args['id'],
            'user_id' => $this->auth->id
        ])->first();
    
        if ($experience){
            $experience->delete();
        }

        $user = User::find($this->auth->id);
        $user->recalculateResumeIsCompleted();
        $user->updated_at = time();
        $user->save();
        
        $data = [];
        $data['token'] = $this->token;
        return $data;
    }
}
