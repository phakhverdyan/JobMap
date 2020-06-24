<?php

namespace App\GraphQL\Query\User\Auth;

use App\Business\Administrator;
use App\Business\ManagerLocation;
use App\Candidate\Candidate;
use App\GraphQL\Extensions\AuthQuery;
use App\Mail\VerificationUser;
use App\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class ResendVerificationCodeQuery extends AuthQuery
{
    protected $attributes = [
        'name' => 'Resend VerificationCode'
    ];
    
    public function type()
    {
        return GraphQL::type('SendVerificationCode');
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args)
    {
        $user = User::find($this->auth->id);

        if ($user) {
            Mail::to($user->email)
                ->queue(new VerificationUser($user, $this->auth->language_prefix));
            return [ 'response' => true ];
        }

        throw new UnauthorizedHttpException('auth', 'User not login!');
        //return [ 'response' => false ];
    }
}
