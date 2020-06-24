<?php

namespace App\GraphQL\Mutation\User\Resume\Reference;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Reference;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Mail;

class SendMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'Send message Reference'
    ];
    
    public function type()
    {
        return GraphQL::type('SendReference');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'id' => ['required', 'integer'],
            'message' => ['required', 'string']
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
            'message' => [
                'type' => Type::string(),
                'description' => 'Message of referer'
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
        $reference = Reference::where([
            // 'user_id' => $this->auth->id,
            'id' => $args['id']
        ])->first();
        
        if (!$reference) {
            return null;
        }

        $reference->message = $args['message'];
        $reference->status = 'incoming';
        $reference->remember_token = null;
        $reference->save();

        Mail::to($reference->user->email)->queue(new \App\Mail\UserRefererCompletedReference($reference->user, $reference, 'INITIAL', $this->auth->language_prefix));

        return [
            'token' => $this->token,
            'redirect' => '/'
        ];
    }
}
