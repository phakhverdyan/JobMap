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
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class CreateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'New User Reference'
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
            'email' => ['required', 'string', 'email'],
            'phone' => ['required', 'string'],
            'full_name' => ['required', 'string', 'regex:/(^([a-z\sA-Z]+)?$)/u'],
            'company' => ['required', 'string'],
            'status' => ['required', 'string'],
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'email' => [
                'type' => Type::string(),
                'description' => 'Email of referer'
            ],
            'phone' => [
                'type' => Type::string(),
                'description' => 'Phone number of referer'
            ],
            'full_name' => [
                'type' => Type::string(),
                'description' => 'Full name of referer'
            ],
            'company' => [
                'type' => Type::string(),
                'description' => 'Company of referer'
            ],
            'status' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Company of referer'
            ],
            'message' => [
                'type' => Type::string(),
                'description' => 'Company of referer'
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
        if ($reference = Reference::where(['user_id' => $this->auth->id, 'email' => $args['email']])->first()) {
            //throw new UnauthorizedHttpException('auth', 'You have already sent a request for this email!');
            $reference['token'] = $this->token;
            $reference['message'] = trans('main.text.you_have_already_sent_a_request');
            return $reference;
        }

        $reference = new Reference;
        $reference->user_id = $this->auth->id;
        $reference->remember_token = md5(str_random(24));

        foreach ($args as $k => $v){
            $reference->{$k} = $v;
        }
    
        $reference->save();

        if (!$reference) {
            return null;
        }

        // Mail::to($reference->email)->queue(new ReferenceSend($reference, $this->auth->language_prefix));
        Mail::to($reference->email)->queue(new \App\Mail\UserInviteReferer($reference->user, $reference, 0, $this->auth->language_prefix));
        $reference['token'] = $this->token;
        $user = User::find($this->auth->id);
        $user->updated_at = $reference->updated_at;
        $user->save();
        return $reference;
    }
}
