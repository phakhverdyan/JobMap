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

class ChatMessageQuery extends AuthQuery
{
    protected $attributes = [
        'name' => 'Get chat message'
    ];

    public function type()
    {
        return GraphQL::type('ChatMessage');
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
            'chat_message_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the chat message'
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

        if (!$chat_message = $chat->messages()->where('id', $args['chat_message_id'])->first()) {
            throw new \Exception('The chat message not found.');
        }

        $chat_interlocutor = $chat->interlocutors()
            ->where('user_id', $this->auth->id)
            ->where('business_id', (isset($args['business_id']) && $args['business_id']) ? $args['business_id'] : 0)
            ->first();

        $chat_message->load('interlocutor', 'interlocutor.user', 'interlocutor.business');
        $chat_message->load('member', 'member.user', 'member.business');

        $chat_message->load(['read_interlocutors' => function($query) use ($chat_interlocutor) {
            if ($chat_interlocutor) {
                $query->where('id', '!=', $chat_interlocutor->id);
            }
        }, 'read_interlocutors.user', 'read_interlocutors.business']);

        $chat_message->load('interview_request');
        $chat_message->state = ($chat_message->id <= $chat->last_read_message_id ? 'read' : 'sent');
        $chat_message->token = $this->token;
        return $chat_message;
    }
}