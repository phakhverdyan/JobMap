<?php

namespace App\GraphQL\Mutation\User;

use App\GraphQL\AuthToken;
use App\Mail\BusinessNotifications;
use App\Mail\VerificationUser;
use App\User\Resume\Availability;
use App\User\Resume\BasicInfo;
use App\User\Resume\Preference;
use App\UserSocials;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\User;
use Illuminate\Support\Facades\DB;
use Folklore\GraphQL\Error\ValidationError;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class SendVerificationCodeMutation extends Mutation
{
    use AuthToken;
    
    protected $attributes = [
        'name' => 'Change Password'
    ];
    
    public function type()
    {
        return GraphQL::type('SendVerificationCode');
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
                'name' => 'id',
                'type' => Type::nonNull(Type::id()),
            ],
            'email' => [
                'name' => 'email',
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
        $user = User::find($args['id']);

        if ($user) {
            Mail::to($args['email'])
                ->queue(new VerificationUser($user, $user->language_prefix));
            return [ 'response' => true ];
        }

        throw new UnauthorizedHttpException('auth', 'User not login!');
        //return [ 'response' => false ];
    }
}
