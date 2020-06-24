<?php

namespace App\GraphQL\Mutation\User;

use App\GraphQL\AuthToken;
use App\Mail\BusinessNotifications;
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

class ChangePasswordMutation extends Mutation
{
    use AuthToken;
    
    protected $attributes = [
        'name' => 'Change Password'
    ];
    
    public function type()
    {
        return GraphQL::type('ChangePassword');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'id' => ['integer'],
            'password' => ['required', 'min:6', 'max:12'],
            'confirm_password' => ['required', 'required_with:password', 'same:password', 'min:6', 'max:12']
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'password' => [
                'name' => 'password',
                'type' => Type::string(),
            ],
            'confirm_password' => [
                'name' => 'confirm_password',
                'type' => Type::string(),
            ],
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::id()),
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

        if (!$user) {
            throw new UnauthorizedHttpException('auth', 'Invalid token!');
        }

        $user->update([
            'password' => bcrypt($args['password']),
            'remember_token' => null,
        ]);

        $this->credentials = [
            'email' => $user->email,
            'password' => $args['password']
        ];
        
        return [
            'token' => $this->getToken(),
            'redirect' => '/user/dashboard'
        ];
    }
}
