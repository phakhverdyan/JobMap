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

class ChatMessagesQuery extends AuthQuery
{
    protected $attributes = [
        'name' => 'List of chat messages',
    ];

    public function type() {
        return GraphQL::type('ChatMessages');
    }

    /**
     * @return array
     */
    public function args() {
        return [
            'chat_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the chat',
            ],

            'business_id' => [
                'type' => Type::int(),
                'description' => 'The id of the business (optional)',
            ],

            'after_id' => [
                'type' => Type::int(),
                'description' => 'The chat message ID after which it returns chat messages (not included `after_id` itself) (optional) (ordering by ID ascend)',
            ],

            'around_id' => [
                'type' => Type::int(),
                'description' => 'The chat message ID around which it returns chat messages (included `around_id` itself) (optional)',
            ],

            'before_id' => [
                'type' => Type::int(),
                'description' => 'The chat message ID before which it returns chat messages (not included `before_id` itself`) (optional) (ordering by ID ascend)'
            ],

            'count' => [
                'type' => Type::int(),
                'description' => 'Count of chat messages to return (optional, default: 10)',
            ],

            'text' => [
                'type' => Type::string(),
                'description' => 'Text for search messages (optional)',
            ],

            'ordering' => [
                'type' => Type::string(),
                'description' => 'Ordering of messages to get. Default: if before_id set, desc; if after_id set, asc; otherwhise, desc;',
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

        $chat_interlocutor = $chat->interlocutors()
            ->where('user_id', $this->auth->id)
            ->where('business_id', (isset($args['business_id']) && $args['business_id']) ? $args['business_id'] : 0)
            ->first();

        $after_id = isset($args['after_id']) ? (int) $args['after_id'] : 0;
        $around_id = isset($args['around_id']) ? (int) $args['around_id'] : 0;
        $before_id = isset($args['before_id']) ? (int) $args['before_id'] : 0;
        $ordering = isset($args['ordering']) ? $args['ordering'] : null;
        $ordering = in_array($ordering, [ 'asc', 'desc' ]) ? $ordering : null;
        $count = isset($args['count']) ? (int) $args['count'] : 10;
        $count = min(max($count, 1), 100);

        $before_chat_message_query = $chat->messages();
        $chat_message_query = $chat->messages();
        $after_chat_message_query = $chat->messages();

        if ($around_id) {
            $chat_message_query->where('id', $around_id);
        }
        elseif ($after_id && $before_id) {
            $chat_message_query->where('id', '>', $after_id)->where('id', '<', $before_id)->orderBy('id', $ordering ? $ordering : 'asc');
        }
        elseif ($after_id) {
            $chat_message_query->where('id', '>', $after_id)->orderBy('id', 'asc');
        }
        elseif ($before_id) {
            $chat_message_query->where('id', '<', $before_id)->orderBy('id', 'desc');
        }
        else {
            $chat_message_query->orderBy('id', $ordering ? $ordering : 'desc');
        }

        if (!$around_id) {
            if (isset($args['text']) && $args['text']) {
                $before_chat_message_query->where('text', 'like', '%' . trim($args['text']) . '%');
                $chat_message_query->where('text', 'like', '%' . trim($args['text']) . '%');
                $after_chat_message_query->where('text', 'like', '%' . trim($args['text']) . '%');
            }
        }

        $count_of_chat_messages_before = 0;
        $count_of_chat_messages_after = 0;

        if ($around_id) {
            $chat_message_query->with('interlocutor', 'interlocutor.user', 'interlocutor.business');
            $chat_message_query->with('member', 'member.user', 'member.business');

            $chat_message_query->with(['read_interlocutors' => function($query) use ($chat_interlocutor) {
                if ($chat_interlocutor) {
                    $query->where('id', '!=', $chat_interlocutor->id);
                }
            }, 'read_interlocutors.user', 'read_interlocutors.business']);

            $chat_message_query->with('interview_request');
            $middle_chat_message = $chat_message_query->first();

            $before_chat_messages = $chat->messages()
                ->with('interlocutor', 'interlocutor.user', 'interlocutor.business')
                ->with('member', 'member.user', 'member.business')

                ->with(['read_interlocutors' => function($query) use ($chat_interlocutor) {
                    if ($chat_interlocutor) {
                        $query->where('id', '!=', $chat_interlocutor->id);
                    }
                }, 'read_interlocutors.user', 'read_interlocutors.business'])

                ->with('interview_request')
                ->where('id', '<', $around_id)
                ->orderBy('id', 'desc')
                ->take($count)
                ->get()
                ->sortBy('id')
                ->values();

            $after_chat_messages = $chat->messages()
                ->with('interlocutor', 'interlocutor.user', 'interlocutor.business')
                ->with('member', 'member.user', 'member.business')

                ->with(['read_interlocutors' => function($query) use ($chat_interlocutor) {
                    if ($chat_interlocutor) {
                        $query->where('id', '!=', $chat_interlocutor->id);
                    }
                }, 'read_interlocutors.user', 'read_interlocutors.business'])

                ->with('interview_request')
                ->where('id', '>', $around_id)
                ->orderBy('id', 'asc')
                ->take($count)
                ->get()
                ->sortBy('id')
                ->values();

            $chat_messages = collect();
            $chat_messages = $chat_messages->concat($before_chat_messages);
            $chat_messages = $chat_messages->concat($middle_chat_message ? [$middle_chat_message] : []);
            $chat_messages = $chat_messages->concat($after_chat_messages);

            if ($before_chat_messages->count() > 0) {
                $count_of_chat_messages_before = $chat->messages()->where('id', '<', $before_chat_messages->first()->id)->count();
            }

            if ($after_chat_messages->count() > 0) {
                $count_of_chat_messages_after = $chat->messages()->where('id', '>', $after_chat_messages->last()->id)->count();
            }
        }
        else {
            $chat_message_query->with('interlocutor', 'interlocutor.user', 'interlocutor.business');
            $chat_message_query->with('member', 'member.user', 'member.business');

            $chat_message_query->with(['read_interlocutors' => function($query) use ($chat_interlocutor) {
                if ($chat_interlocutor) {
                    $query->where('id', '!=', $chat_interlocutor->id);
                }
            }, 'read_interlocutors.user', 'read_interlocutors.business']);

            $chat_message_query->with('interview_request');
            $chat_messages = $chat_message_query->take($count)->get()->sortBy('id')->values();

            if ($before_id && $after_id) {
                if ($chat_messages->count() > 0) {
                    $count_of_chat_messages_before = $before_chat_message_query->where('id', '<', $chat_messages->first()->id)->count();
                    $count_of_chat_messages_after = $after_chat_message_query->where('id', '>', $chat_messages->last()->id)->count();
                }
                else {
                    $count_of_chat_messages_before = $before_chat_message_query->where('id', '<=', $after_id)->count();
                    $count_of_chat_messages_after = $after_chat_message_query->where('id', '>=', $before_id)->count();
                }
            }
            elseif ($after_id) {
                $count_of_chat_messages_before = $before_chat_message_query->where('id', '<=', $after_id)->count();

                if ($chat_messages->count() >= $count) {
                    $count_of_chat_messages_after = $after_chat_message_query->where('id', '>', $chat_messages->last()->id)->count();
                }
            }
            elseif ($before_id) {
                if ($chat_messages->count() >= $count) {
                    $count_of_chat_messages_before = $before_chat_message_query->where('id', '<', $chat_messages->first()->id)->count();
                }

                $count_of_chat_messages_after = $after_chat_message_query->where('id', '>=', $before_id)->count();
            }
            else {
                if ($chat_messages->count() >= $count) {
                    $count_of_chat_messages_before = $before_chat_message_query->where('id', '<', $chat_messages->first()->id)->count();
                    $count_of_chat_messages_after = $after_chat_message_query->where('id', '>', $chat_messages->last()->id)->count();
                }
            }
        }

        foreach ($chat_messages as $chat_message) {
            $chat_message->state = ($chat_message->id <= $chat->last_read_message_id ? 'read' : 'sent');
        }

        return [
            'count_of_chat_messages_before' => $count_of_chat_messages_before,
            'chat_messages' => $chat_messages,
            'count_of_chat_messages_after' => $count_of_chat_messages_after,
            'token' => $this->token,
        ];
    }
}
