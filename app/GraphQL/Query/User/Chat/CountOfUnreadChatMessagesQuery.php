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

class CountOfUnreadChatMessagesQuery extends AuthQuery
{
    protected $attributes = [
        'name' => 'Count of unread chat messages',
    ];

    public function type() {
        return GraphQL::type('CountOfUnreadChatMessages');
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
                'type' => Type::int(),
                'description' => 'The id of the business (optional)',
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

        $chat_message_query = \App\ChatMessage::query();
        $chat_message_query->join('chat_members', 'chat_members.chat_id', '=', 'chat_messages.chat_id');

        $chat_message_query->leftJoin('chat_interlocutors', function($join) use ($args) {
            $join->on('chat_interlocutors.chat_id', '=', 'chat_messages.chat_id');

            if (isset($args['business_id']) && $args['business_id']) {
                $join->on('chat_interlocutors.user_id', '=', DB::raw($this->auth->id));
                $join->on('chat_interlocutors.business_id', '=', DB::raw($args['business_id']));
            }
            else {
                $join->on('chat_interlocutors.user_id', '=', DB::raw($this->auth->id));
                $join->on('chat_interlocutors.business_id', '=', DB::raw(0));
            }
        });

        if (isset($args['business_id']) && $args['business_id']) {
            $chat_message_query->where('chat_members.business_id', $args['business_id']);
            $chat_message_query->where('chat_members.manager_id', $this->auth->id);
        }
        else {
            $chat_message_query->where('chat_members.user_id', $this->auth->id);
        }

        $chat_message_query->whereRaw('chat_messages.id > IFNULL(chat_interlocutors.last_read_message_id, 0)');
        $total_count = $chat_message_query->count();
        $count = 0;

        if (isset($args['chat_id']) && $args['chat_id']) {
            $chat_message_query = \App\ChatMessage::query();
            $chat_message_query->join('chat_members', 'chat_members.chat_id', '=', 'chat_messages.chat_id');

            $chat_message_query->leftJoin('chat_interlocutors', function($join) use ($args) {
                $join->on('chat_interlocutors.chat_id', '=', 'chat_messages.chat_id');

                if (isset($args['business_id']) && $args['business_id']) {
                    $join->on('chat_interlocutors.user_id', '=', DB::raw($this->auth->id));
                    $join->on('chat_interlocutors.business_id', '=', DB::raw($args['business_id']));
                }
                else {
                    $join->on('chat_interlocutors.user_id', '=', DB::raw($this->auth->id));
                    $join->on('chat_interlocutors.business_id', '=', DB::raw(0));
                }
            });

            if (isset($args['business_id']) && $args['business_id']) {
                $chat_message_query->where('chat_members.business_id', $args['business_id']);
                $chat_message_query->where('chat_members.manager_id', $this->auth->id);
            }
            else {
                $chat_message_query->where('chat_members.user_id', $this->auth->id);
            }

            $chat_message_query->where('chat_messages.chat_id', $args['chat_id']);
            $chat_message_query->whereRaw('chat_messages.id > IFNULL(chat_interlocutors.last_read_message_id, 0)');
            $count = $chat_message_query->count();
        }

        return [
            'total_count' => $total_count,
            'count' => $count,
            'token' => $this->token,
        ];
    }
}
