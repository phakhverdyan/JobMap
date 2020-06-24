<?php

namespace App\GraphQL\Mutation\User;

use App\GraphQL\OptionalAuth;
use GraphQL;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Log;

class ShareLinkMutation extends Mutation
{
    use OptionalAuth;

    public function type()
    {
        return GraphQL::type('ShareLink');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            //
        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'email' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'link' => [
                'type' => Type::nonNull(Type::string()),
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
        if (!isset($this->auth)) {
            $user = new \App\User();
            $user->first_name = 'JobMap';
        }
        Mail::to($args['email'])->send(new \App\Mail\UserShareLink($this->auth ?? $user, $args['link'], 'INITIAL', $this->auth->language_prefix ?? "en" ));
        return [ 'response' => 'ok' ];
    }
}
