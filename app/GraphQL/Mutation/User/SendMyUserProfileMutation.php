<?php

namespace App\GraphQL\Mutation\User;

use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\Mail\FeedbackSend;
use App\Mail\MyUserProfileSend;
use App\Mail\VerificationUser;
use App\SendUserProfile;
use App\User\Feedback;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\User;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class SendMyUserProfileMutation extends Mutation
{
    use Auth;

    protected $attributes = [
        'name' => 'sendMyUserProfile'
    ];

    public function type()
    {
        return GraphQL::type('SendMyUserProfile');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'email' => ['required', 'email', 'max:100'],
            'type' => ['required', 'string'],
        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'type' => [
                'type' => Type::string()
            ],
            'email' => [
                'type' => Type::string()
            ],
            'message' => [
                'type' => Type::string()
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
        $data = new SendUserProfile();
        $data->user_id = $this->auth->id;
        foreach ($args as $k => $v){
            $data->{$k} = $v;
        }
        $data->save();

        Mail::to($data->email)->queue(new MyUserProfileSend($data, $this->auth, $this->auth->language_prefix));

        return [
            'response' => 'success',
            'token' => $this->token
        ];
    }
}
