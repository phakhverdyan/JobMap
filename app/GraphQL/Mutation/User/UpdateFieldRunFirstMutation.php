<?php

namespace App\GraphQL\Mutation\User;

use App\GraphQL\Auth;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\User;

class UpdateFieldRunFirstMutation extends Mutation
{
    //use JWT authorization
    use Auth;

    protected $attributes = [
        'name' => 'UpdateFieldRunFirst'
    ];

    public function type()
    {
        return GraphQL::type('UpdateFieldRunFirst');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [

        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'run_first' => [
                'name' => 'run_first',
                'type' => Type::nonNull(Type::int()),
            ]
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return null
     */
    public function resolve($root, $args)
    {
        $user = User::find($this->auth->id);
        if (!$user) {
            return null;
        }

        $user->run_first = $args['run_first'];;
        $user->save();

        $data = [];
        $data['token'] = $this->token;
        $data['response'] = 'ok';
        return $data;
    }
}
