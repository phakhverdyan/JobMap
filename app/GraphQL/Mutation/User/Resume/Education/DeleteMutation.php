<?php

namespace App\GraphQL\Mutation\User\Resume\Education;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Education;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'Delete User Education'
    ];
    
    public function type()
    {
        return GraphQL::type('UserEducation');
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
                'description' => 'Education ID'
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
        $education = Education::where([
            'id' => $args['id'],
            'user_id' => $this->auth->id
        ])->first();
    
        if ($education) {
            $education->delete();
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
