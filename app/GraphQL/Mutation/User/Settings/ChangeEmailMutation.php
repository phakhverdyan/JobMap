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
use Tymon\JWTAuth\Facades\JWTAuth;

class ChangeEmailMutation extends Mutation
{
    use AuthToken;
    
    protected $attributes = [
        'name' => 'Change Email'
    ];
    
    public function type()
    {
        return GraphQL::type('ChangeEmail');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'id' => ['required', 'integer'],
            'email' => ['required', 'email', 'unique:users,email'],
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
            ],
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::id()),
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
        $user = User::find($args['id']);

        if (!$user) {
            throw new UnauthorizedHttpException('auth', 'Invalid token!');
        }

        $user->new_email = $args['email'];

        // generating a random confirmation code until it is unique

        while (true) {
            $user->new_email_confirmation_code = str_random(32);

            if (\App\User::where('new_email_confirmation_code', $user->new_email_confirmation_code)->first()) {
                continue;
            }

            break;
        }

        $user->save();
        Mail::to($user->new_email)->queue(new \App\Mail\UserChangeEmail($user, 'INITIAL', $user->language_prefix));
        
        // $user->update([
        //     'email' => $args['email'],
        //     'remember_token' => null
        // ]);

        // $token = JWTAuth::fromUser($user);
        
        return [
            'token' => $this->token,
            // 'result' => 'success',
        ];
    }
}
