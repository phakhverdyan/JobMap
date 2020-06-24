<?php

namespace App\GraphQL\Mutation\User\Resume\Reference;

use App\GraphQL\Auth;
use App\Mail\ReferenceSend;
use App\User;
use App\User\Resume\Reference;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Mail;

class ResendMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'Resend and Update User Reference'
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
            'email' => ['required', 'string', 'email']
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
            'user_id' => $this->auth->id,
            'id' => $args['id']
        ])->update(['email' => $args['email']]);

        if (!$reference = Reference::where(['user_id' => $this->auth->id, 'id' => $args['id']])->first()) {
            return null;
        }
        
        Mail::to($reference->email)->queue(new \App\Mail\UserInviteReferer($reference->user, $reference, 0, $this->auth->language_prefix));
        $reference->token = $this->token;

        $user = User::find($this->auth->id);
        $user->updated_at = $reference['updated_at'];
        $user->save();
        
        return $reference;
    }
}