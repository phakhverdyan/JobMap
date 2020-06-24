<?php

namespace App\GraphQL\Mutation\User\Settings;

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

class ChangePassMutation extends Mutation
{
    use AuthToken;
    
    protected $attributes = [
        'name' => 'Change Pass'
    ];
    
    public function type()
    {
        return GraphQL::type('ChangePass');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        $args = func_get_args()[1];
        $id = (isset($args['id']) && $args['id']) ? (integer) $args['id'] : 0;

        return [
            'id' => ['required', 'integer'],
            'current_password' => ['required', 'min:6', 'max:12', 'current_password:' . $args['id']],
            'new_password' => ['required', 'min:6', 'max:12', 'confirmed'],
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'current_password' => [
                'type' => Type::string(),
            ],
            'new_password' => [
                'type' => Type::string(),
            ],
            'new_password_confirmation' => [
                'type' => Type::string(),
            ],
            'id' => [
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

        if (!\Hash::check($args['current_password'], $user->password)) {
            $exception = \Illuminate\Validation\ValidationException::withMessages([
               'current_password' => ['Wrong current password'],
            ]);

            throw $exception;
        }

        $user->new_password = bcrypt($args['new_password']);

        // generating a random confirmation code until it is unique

        while (true) {
            $user->new_password_confirmation_code = str_random(32);

            if (\App\User::where('new_password_confirmation_code', $user->new_password_confirmation_code)->first()) {
                continue;
            }

            break;
        }

        $user->save();
        Mail::to($user->email)->queue(new \App\Mail\UserChangePassword($user, 'INITIAL', $user->language_prefix));

        // $user->update([
        //     'password' => bcrypt($args['password']),
        //     'remember_token' => null
        // ]);

        // $this->credentials = [
        //     'email' => $user->email,
        //     'password' => $args['password']
        // ];
        
        return [
            'token' => $this->token, // $this->getToken(),
            'result' => 'success'
        ];
    }
}
