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

class EmitChatTypingQuery extends AuthQuery
{
    protected $attributes = [
        'name' => 'Emit chat typing',
    ];

    public function type() {
        return GraphQL::type('EmitChatTyping');
    }

    /**
     * @return array
     */
    public function args() {
        return [
            'business_id' => [
                'type' => Type::int(),
                'description' => 'The id of the business (optional)',
            ],
            'chat_id' => [
                'type' => Type::id(),
                'description' => 'The id of the chat',
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
            throw new \Exception('The chat is not found.');
        }

        $chat_members = $chat->members()->get();

        if (isset($args['business_id']) && $args['business_id']) {
            if (!$chat_members->where('business_id', $args['business_id'])->first()) {
                throw new \Exception('Permission error.');
            }
        }
        else {
            if (!$chat_members->where('user_id', $this->auth->id)->first()) {
                throw new \Exception('Permission error.');
            }
        }

        $chat_interlocutor = $chat->interlocutors()
            ->where('user_id', $this->auth->id)
            ->where('business_id', (isset($args['business_id']) && $args['business_id']) ? $args['business_id'] : 0)
            ->first();

        if (!$chat_interlocutor) {
            $chat_interlocutor = new \App\ChatInterlocutor;
            $chat_interlocutor->chat_id = $chat->id;
            $chat_interlocutor->user_id = $this->auth->id;
            $chat_interlocutor->business_id = (isset($args['business_id']) && $args['business_id']) ? $args['business_id'] : 0;
            $chat_interlocutor->last_read_message_id = 0;
            $chat_interlocutor->save();
        }

        realtime($chat_members->map(function($chat_member) {
            if ($chat_member->user_id) {
                return ['type' => 'User', 'id' => $chat_member->user_id];
            }
            
            if ($chat_member->business_id) {
                return ['type' => 'Business', 'id' => $chat_member->business_id];
            }

            return null;
        })->filter(function($chat_member) {
            return $chat_member;
        })->toArray())->emit('chats.typing', [
            'chat_id' => $chat->id,
            'chat_interlocutor_id' => $chat_interlocutor->id,
        ]);

        return [
            'token' => $this->token,
        ];
    }
}