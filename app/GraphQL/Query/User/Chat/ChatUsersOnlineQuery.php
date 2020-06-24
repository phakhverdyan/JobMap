<?php
/**
 * Created by PhpStorm.
 * User: alexey
 * Date: 07.03.18
 * Time: 15:52
 */

namespace App\GraphQL\Query\User\Chat;

use App\Chat;
use App\GraphQL\Extensions\AuthQuery;
use App\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;

class ChatUsersOnlineQuery extends AuthQuery
{

    protected $attributes = [
        'name' => 'List online users'
    ];

    public function type()
    {
        return GraphQL::type('Chats');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'business_id' => [
                'type' => Type::id(),
                'description' => 'The id of the business'
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args)
    {
        $query = Chat::query();
        if (isset($args['business_id'])) {
            $query->join('users', 'users.id', '=', 'chats.user_id');
            $query->where('chats.business_id', '=', $args['business_id']);
        } else {
            $query->join('businesses', 'businesses.id', '=', 'chats.business_id');
            $query->where('chats.user_id', '=', $this->auth->id);
        }
        $data = $query->get()->all();


        return [
            'items' => $data,
            'token' => $this->token
        ];
    }
}
