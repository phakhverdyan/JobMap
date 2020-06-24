<?php

namespace App\GraphQL\Query\User;

use App\Mail\ResetPassword;
use App\User;
use Folklore\GraphQL\Error\ValidationError;
use Folklore\GraphQL\Support\Traits\ShouldValidate;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class ResetPasswordQuery extends Query
{
    use ShouldValidate;

    protected $attributes = [
        'name' => 'Reset Password'
    ];

    public function type()
    {
        return GraphQL::type('ResetPassword');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'email' => ['required', 'string', 'email']
        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'email' => ['name' => 'email', 'type' => Type::string()]
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args)
    {
        $user = User::where('email', $args['email'])->first();

        if ($user) {
            $user->update([ 'remember_token' => md5(str_random(24)) ]);
            Mail::to($user->email)
                ->queue(new ResetPassword($user, $user->language_prefix));
            return [ 'response' => true ];
        }

        throw new UnauthorizedHttpException('auth', 'Invalid email or password!');
        //return [ 'response' => false ];
    }
}
