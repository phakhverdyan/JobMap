<?php

namespace App\GraphQL\Mutation\User\Resume\Certification;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Certification;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'Delete User Certification'
    ];
    
    public function type()
    {
        return GraphQL::type('UserCertification');
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
                'description' => 'Certification ID'
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
        $certification = Certification::where([
            'id' => $args['id'],
            'user_id' => $this->auth->id
        ])->first();
    
        if ($certification) {
            $certification->delete();
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
