<?php
/**
 * Created by PhpStorm.
 * User: alexey
 * Date: 07.03.18
 * Time: 15:52
 */

namespace App\GraphQL\Query\User\Chat;

use App\User;
use App\GraphQL\Extensions\AuthQuery;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
//use App\GraphQL\Query\User\Auth\DB;
use Illuminate\Support\Facades\DB;

class ChatInterlocutorQuery extends AuthQuery
{
    protected $attributes = [
        'name' => 'Get chat interlocutor'
    ];

    public function type()
    {
        return GraphQL::type('ChatInterlocutor');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'chat_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the chat'
            ],
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the business'
            ],
            'chat_interlocutor_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the chat interlocutor'
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args) {
        if (isset($args['business_id']) && $args['business_id']) {
            $this->checkBusinessAccess($args['business_id'], [
                \App\Business\Administrator::MANAGER_ROLE,
                \App\Business\Administrator::BRANCH_ROLE,
            ], ['chats']);
        }
        
        if (!$chat = \App\Chat::where('id', $args['chat_id'])->first()) {
            throw new \Exception('The chat not found.');
        }

        if (isset($args['business_id']) && $args['business_id']) {
            if (!$chat->members()->where('business_id', $args['business_id'])->first()) {
                throw new \Exception('Permission error.');
            }
        }
        else {
            if (!$chat->members()->where('user_id', $this->auth->id)->first()) {
                throw new \Exception('Permission error.');
            }
        }

        if (!$chat_interlocutor = $chat->interlocutors()->where('id', $args['chat_interlocutor_id'])->first()) {
            throw new \Exception('The chat message not found.');
        }

        $chat_interlocutor->load('user', 'business');
        $chat_interlocutor->token = $this->token;
        return $chat_interlocutor;
    }
}