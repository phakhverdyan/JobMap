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
use App\Business\Administrator;

class ChatQuery extends AuthQuery
{

    protected $attributes = [
        'name' => 'Get chat'
    ];

    public function type()
    {
        return GraphQL::type('Chat');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'chat_id' => [
                'type' => Type::id(),
                'description' => 'The id of the chat'
            ],
            'with_user_id' => [
                'type' => Type::string(),
                'description' => 'The user_id to find the chat',
            ],
            'with_business_id' => [
                'type' => Type::string(),
                'description' => 'The business_id to find the chat',
            ],
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
        if (isset($args['business_id']) && $args['business_id']) {
            $this->checkBusinessAccess($args['business_id'], [
                \App\Business\Administrator::MANAGER_ROLE,
                \App\Business\Administrator::BRANCH_ROLE,
            ], ['chats']);
        }

        if (isset($args['chat_id'])) {
            if (!$chat = \App\Chat::where('id', $args['chat_id'])->first()) {
                throw new \Exception('The chat is not found.');
            }

            if (isset($args['business_id']) && $args['business_id']) {
                // if (!$chat->members()->where('business_id', $args['business_id'])->first()) {
                //     throw new \Exception('Permission error.');
                // }
            }
            else {
                if (!$chat->members()->where('user_id', $this->auth->id)->first()) {
                    throw new \Exception('Permission error.');
                }
            }
        }
        else {
            if (isset($args['business_id']) && $args['business_id']) {
                if (!isset($args['with_user_id']) || !$args['with_user_id']) {
                    return null;
                }

                // $authManagerRole = get_manager_role($args['business_id']);

                $chat_query = Chat::query();
                $chat_query->join('chat_members AS CM0', 'chats.id', '=', 'CM0.chat_id');
                $chat_query->join('chat_members AS CM1', 'chats.id', '=', 'CM1.chat_id');
                $chat_query->where('CM0.manager_id', $this->auth->id);
                $chat_query->where('CM0.business_id', $args['business_id']);
                $chat_query->where('CM1.user_id', $args['with_user_id']);

                // if ($authManagerRole === Administrator::FRANCHISE_ROLE) {
                //     $chat_query->where('CM0.manager_id', $this->auth->id);
                // }

                $chat_query->select('chats.*');

                if (!$chat = $chat_query->first()) {
                    return null;
                }
            }
            else {
                if (!isset($args['with_business_id']) || !$args['with_business_id']) {
                    return null;
                }

                $chat_query = Chat::query();
                $chat_query->join('chat_members AS CM0', 'chats.id', '=', 'CM0.chat_id');
                $chat_query->join('chat_members AS CM1', 'chats.id', '=', 'CM1.chat_id');
                $chat_query->where('CM0.business_id', $args['with_business_id']);
                $chat_query->where('CM1.user_id', $this->auth->id);
                $chat_query->select('chats.*');

                if (!$chat = $chat_query->first()) {
                    return null;
                }
            }
        }

        $chat_message_query = \App\ChatMessage::query();
        $chat_message_query->join('chat_members', 'chat_members.chat_id', '=', 'chat_messages.chat_id');

        $chat_message_query->leftJoin('chat_interlocutors', function($join) use ($args) {
            $join->on('chat_interlocutors.chat_id', '=', 'chat_messages.chat_id');

            if (isset($args['business_id']) && $args['business_id']) {
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

        $chat_message_query->where('chat_messages.chat_id', $chat->id);
        $chat_message_query->whereRaw('chat_messages.id > IFNULL(chat_interlocutors.last_read_message_id, 0)');
        $chat->count_of_unread_messages = $chat_message_query->count();
        $chat->secret_token = hash_hmac('sha256', $chat->id, 'Bobik-Chat-secret-token');
        $chat->token = $this->token;

        // if (isset($args['business_id']) && $args['business_id']) {
        //     $currentUser = $this->auth->id;
        //     $currentManagerRole = get_manager_role($args['business_id']);

        //     if ($firstMember = $chat->members->first()) {
        //         if ($manager = $firstMember->manager) {
        //             $managerRole = get_manager_role($args['business_id'], $firstMember->manager->getKey());

        //             if ($currentManagerRole === Administrator::FRANCHISE_ROLE) {
        //                 return $manager->getKey() == $currentUser;
        //             } else {
        //                 return false;
        //             }
        //         }
        //     }

        // }

        return $chat;
    }
}
