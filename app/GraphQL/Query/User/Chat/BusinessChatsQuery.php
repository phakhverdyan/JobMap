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
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\DB;

class BusinessChatsQuery extends AuthQuery
{
    protected $attributes = [
        'name' => 'Business chats'
    ];

    public function type() {
        return GraphQL::type('Chats');
    }

    /**
     * @return array
     */
    public function args() {
        return [
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the business',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of some user for search (optional)',
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args) {
        $this->checkBusinessAccess($args['business_id'], [
            \App\Business\Administrator::MANAGER_ROLE,
            \App\Business\Administrator::BRANCH_ROLE,
        ], ['chats']);

        $query = Chat::query();
        $query->where('chats.business_id', '=', $args['business_id']);
        $query->join('users', 'users.id', '=', 'chats.user_id');
        
        if (isset($args['name']) && $args['name'] !== '') {
            if (stristr($args['name'], ' ') !== FALSE) {
                list($name1, $name2) = explode(' ', $args['name']);

                $query->orWhere([
                    ['users.first_name', 'like', '%' . trim($name1) . '%'],
                    ['users.last_name', 'like', '%' . trim($name2) . '%'],
                    ['users.first_name', 'like', '%' . trim($name2) . '%'],
                    ['users.last_name', 'like', '%' . trim($name1) . '%'],
                ]);
            } else {
                $query->orWhere([
                    ['users.first_name', 'like', '%' . trim($args['name']) . '%'],
                    ['users.last_name', 'like', '%' . trim($args['name']) . '%'],
                ]);
            }
        }
        
        $query->select('chats.*');
        $chats = $query->orderBy('last_message_id', 'desc')->get();

        foreach ($chats as $chat) {
            $chat->interlocutor_type = 'Business';
            $chat->secret_token = hash('sha256', $chat->id . $chat->interlocutor_type . '39k4d92m92');
        }

        return [
            'chats' => $chats,
            // 'token' => $this->token,
        ];
    }
}
