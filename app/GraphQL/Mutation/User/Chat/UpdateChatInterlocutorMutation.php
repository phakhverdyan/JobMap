<?php

namespace App\GraphQL\Mutation\User\Chat;

use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\Business\Administrator;
use App\Chat;
use App\WorldLanguage;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;
use Folklore\GraphQL\Error\ValidationError;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class UpdateChatInterlocutorMutation extends Mutation
{
    use Auth;

    protected $attributes = [
        'name' => 'Update chat interlocutor',
    ];

    public function type()
    {
        return GraphQL::type('ChatInterlocutor');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'chat_id' => ['required', 'numeric'],
        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'business_id' => [
                'type' => Type::id(),
            ],
            'chat_id' => [
                'type' => Type::id(),
            ],
            'last_read_message_id' => [
                'type' => Type::id(),
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args) {
        if (isset($args['business_id']) && $args['business_id']) {
            $this->checkBusinessAccess($args['business_id'], [
                \App\Business\Administrator::MANAGER_ROLE,
                \App\Business\Administrator::BRANCH_ROLE,
            ], ['chats']);
        }

        if (!$chat = \App\Chat::where('id', $args['chat_id'])->first()) {
            throw new \Exception('The chat is not found');
        }

        $chat_members = $chat->members()->get();

        if (isset($args['business_id']) && $args['business_id']) {
            $chat_member = $chat_members->where('business_id', $args['business_id'])->first();
        }
        else {
            $chat_member = $chat_members->where('user_id', $this->auth->id)->first();
        }

        if (!$chat_member) {
            throw new \Exception('Permission error.');
        }

        $chat_interlocutor = $chat->interlocutors()
            ->where('user_id', $this->auth->id)
            ->where('business_id', isset($args['business_id']) && $args['business_id'] ? $args['business_id'] : 0)
            ->first();

        if (!$chat_interlocutor) {
            $chat_interlocutor = new \App\ChatInterlocutor;
            $chat_interlocutor->chat_id = $chat->id;
            $chat_interlocutor->user_id = $this->auth->id;
            $chat_interlocutor->business_id = isset($args['business_id']) && $args['business_id'] ? $args['business_id'] : 0;
            $chat_interlocutor->last_read_message_id = 0;
            $chat_interlocutor->save();
        }

        if (isset($args['last_read_message_id']) && $args['last_read_message_id']) {
            if (!$last_read_chat_message = $chat->messages()->where('id', $args['last_read_message_id'])->first()) {
                throw new \Exception('The message is not found by last_read_message_id argument');
            }

            if ($chat_interlocutor->last_read_message_id < $last_read_chat_message->id) {
                $chat_interlocutor->last_read_message_id = $last_read_chat_message->id;
                $chat_interlocutor->save();

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
                })->toArray())->emit('chats.interlocutor_read_last_message', [
                    'chat_id' => $chat->id,
                    'last_read_chat_message_id' => $chat_interlocutor->last_read_message_id,
                    'chat_interlocutor_id' => $chat_interlocutor->id,
                ]);

                if ($chat->last_read_message_id < $last_read_chat_message->id) {
                    $chat->last_read_message_id = $last_read_chat_message->id;
                    $chat->save();

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
                    })->toArray())->emit('chats.last_read_message_updated', [
                        'chat_id' => $chat->id,
                        'last_read_message_id' => $chat->last_read_message_id,
                    ]);
                }
            }
        }

        $chat_interlocutor->token = $this->token;
        return $chat_interlocutor;
    }
}
