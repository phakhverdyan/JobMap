<?php

namespace App\GraphQL\Mutation\User\Resume\Reference;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Reference;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Mail;

class ConfirmedMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'Confirmed User Reference'
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
            'status' => ['required', 'string']
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
            'status' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Reference Status'
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
        if (!$reference = Reference::where('user_id', $this->auth->id)->where('id', $args['id'])->first()) {
            throw new \Exception('Reference not found');
        }
        
        $reference->status = $args['status'];
        $reference->save();

        // Mail::to($reference->email)->queue(new \App\Mail\UserRefererCompletedReference($reference->user, $reference, 0));

        $user = User::find($this->auth->id);
        $user->recalculateResumeIsCompleted();
        $user->updated_at = $reference['updated_at'];
        $user->save();
    
        $reference->token = $this->token;
        return $reference;
    }
}
