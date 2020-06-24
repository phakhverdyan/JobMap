<?php

namespace App\GraphQL\Query\User\Chat;

use App\Chat;
use App\GraphQL\Extensions\AuthQuery;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;
use App\Business\Administrator;

class ChatsQuery extends AuthQuery
{
    protected $attributes = [
        'name' => 'Chat list',
    ];

    public function type() {
        return GraphQL::type('Chats');
    }

    public function args() {
        return [
            'business_id' => [
                'type' => Type::int(),
                'description' => 'The id of the business (optional)',
            ],

            'before_last_message_id' => [
                'type' => Type::int(),
                'description' => 'The last chat message ID before which it returns the rest chats (not included `before_last_message_id` itself) (optional)',
            ],

            'count' => [
                'type' => Type::int(),
                'description' => 'Count of chats to return (optional, default: 50)',
            ],

            'name' => [
                'type' => Type::string(),
                'description' => 'The name of user for search (optional)'
            ],
            'filtering_manager_ids' => [
                'type' => Type::listOf(Type::int()),
            ],
            'filtering_city_region' => [
                'type' => Type::listOf(Type::string()),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['business_id']) && $args['business_id']) {
            $this->checkBusinessAccess($args['business_id'], [
                \App\Business\Administrator::MANAGER_ROLE,
                \App\Business\Administrator::BRANCH_ROLE,
            ], ['chats']);
        }

        $before_last_message_id = isset($args['before_last_message_id']) ? (int) $args['before_last_message_id'] : 0;
        $count = isset($args['count']) ? (int) $args['count'] : 10;
        $count = min(max($count, 1), 100);

        $chat_query = Chat::where('chats.last_message_id', '>', 0);

        if ($before_last_message_id > 0) {
            $chat_query->where('chats.last_message_id', '<', $before_last_message_id);
        }

        $chat_query->join('chat_members AS CM0', 'chats.id', '=', 'CM0.chat_id');

        $isJoinUsers = false;
        if (isset($args['business_id']) && $args['business_id']) {
            $chat_query->where('CM0.business_id', $args['business_id']);

            $chat_query->where('CM0.manager_id', $this->auth->id);

            if (isset($args['name']) && $args['name']) {
                $chat_query->join('chat_members AS CM1', 'chats.id', '=', 'CM1.chat_id');
                $chat_query->join('users', 'users.id', '=', 'CM1.user_id');
                $isJoinUsers = true;

                if (stristr($args['name'], ' ') !== FALSE) {
                    list($name1, $name2) = explode(' ', $args['name']);

                    /*$chat_query->where([
                        ['users.first_name', 'like', '%' . trim($name1) . '%'],
                        ['users.last_name', 'like', '%' . trim($name2) . '%'],
                        ['users.first_name', 'like', '%' . trim($name2) . '%'],
                        ['users.last_name', 'like', '%' . trim($name1) . '%'],
                    ]);*/
                    $chat_query->where(function ($q) use ($name1,$name2){
                        $q->where('users.first_name', 'like', '%' . trim($name1) . '%')
                        ->orWhere('users.last_name', 'like', '%' . trim($name2) . '%')
                        ->orWhere('users.first_name', 'like', '%' . trim($name2) . '%')
                        ->orWhere('users.last_name', 'like', '%' . trim($name1) . '%');
                    });
                }
                else {
                    /*$chat_query->where([
                        ['users.first_name', 'like', '%' . trim($args['name']) . '%'],
                        ['users.last_name', 'like', '%' . trim($args['name']) . '%'],
                    ]);*/
                    $chat_query->where(function ($q) use ($args){
                        $q->where('users.first_name', 'like', '%' . trim($args['name']) . '%')
                            ->orWhere('users.last_name', 'like', '%' . trim($args['name']) . '%');
                    });
                }
            }
        }
        else {
            $chat_query->where('CM0.user_id', $this->auth->id);

            if (isset($args['name']) && $args['name']) {
                $chat_query->join('chat_members AS CM1', 'chats.id', '=', 'CM1.chat_id');
                $chat_query->join('businesses', 'businesses.id', '=', 'CM1.business_id');
                $chat_query->where('businesses.name', 'like', '%' . trim($args['name']) . '%');
            }
        }

        // Franchasee managers check
        if (isset($args['business_id']) && $args['business_id']) {
            if (get_manager_role($args['business_id']) === Administrator::FRANCHISE_ROLE) {
                $chat_query->where('CM0.manager_id', $this->auth->id);
            }
        }

        if (isset($args['filtering_manager_ids']) && count($args['filtering_manager_ids']) > 0) {
            $chat_query->join('chat_interlocutors', 'chat_interlocutors.chat_id', '=', 'chats.id');
            $chat_query->whereIn('chat_interlocutors.user_id', $args['filtering_manager_ids']);
            $chat_query->distinct();
        }

        if (isset($args['filtering_city_region']) && count($args['filtering_city_region']) > 0) {
            if (!$isJoinUsers) {
                $chat_query->join('chat_members AS CM1', 'chats.id', '=', 'CM1.chat_id');
                $chat_query->join('users', 'users.id', '=', 'CM1.user_id');
            }
            $values = $args['filtering_city_region'];
            $chat_query->where(function ($query) use ($values) {
                foreach ($values as $value) {
                    $vals = explode("---", $value);
                    $query->orWhere(function ($query) use ($vals) {
                        if ($vals[1] == 'y' ) {
                            $vs = explode(",", $vals[0]);
                            if (count($vs) == 1) {
                                $query->where('users.region', 'like', '%' . trim($vs[0]) . '%');
                            }
                            if (count($vs) == 2) {
                                $query->where('users.region', 'like', '%' . trim($vs[0]) . '%');
                                $query->where('users.country', 'like', '%' . trim($vs[1]) . '%');
                            }
                            if (count($vs) > 2) {
                                $query->where('users.city', 'like', '%' . trim($vs[0]) . '%');
                                $query->where('users.region', 'like', '%' . trim($vs[1]) . '%');
                                $query->where('users.country', 'like', '%' . trim($vs[2]) . '%');
                            }
                        } else {
                            $query->orWhere('users.city', 'like', '%' . ucfirst(strtolower(trim($vals[0]))) . '%');
                            $query->orWhere('users.region', 'like', '%' . ucfirst(strtolower(trim($vals[0]))) . '%');
                            $query->orWhere('users.country', 'like', '%' . ucfirst(strtolower(trim($vals[0]))) . '%');
                        }
                    });
                }
            });
        }

        $chat_query->select('chats.*');
        $chat_query->with('last_message', 'last_message.interlocutor', 'last_message.interlocutor.user', 'last_message.interlocutor.business');
        $chat_query->with('members', 'members.business', 'members.user');
        $chat_query->orderBy('chats.last_message_id', 'desc')->limit($count);
        $chats = $chat_query->get();

        $chat_message_query = \App\ChatMessage::query();

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

        $chat_message_query->whereIn('chat_messages.chat_id', $chats->pluck('id')->toArray());
        $chat_message_query->whereRaw('chat_messages.id > IFNULL(chat_interlocutors.last_read_message_id, 0)');
        $chat_message_query->select('chat_messages.chat_id', DB::raw('COUNT(*) AS count_of_unread_messages'));
        $unread_chat_message_groups = $chat_message_query->groupBy('chat_messages.chat_id')->get();

        $chat_interlocutors = \App\ChatInterlocutor::whereIn('chat_id', $chats->pluck('id')->toArray())
            ->where('user_id', $this->auth->id)
            ->where('business_id', isset($args['business_id']) && $args['business_id'] ? $args['business_id'] : 0)
            ->get();

        foreach ($chats as $chat) {
            if (!$chat->is_group) {
                if (isset($args['business_id']) && $args['business_id']) {
                    $chat->setRelation('opposite_member', $chat->members->where('business_id', '!=', $args['business_id'])->first());
                }
                else {
                    $chat->setRelation('opposite_member', $chat->members->where('user_id', '!=', $this->auth->id)->first());
                }
            }

            $chat->count_of_unread_messages = 0;

            if ($unread_chat_message_group = $unread_chat_message_groups->where('chat_id', $chat->id)->first()) {
                $chat->count_of_unread_messages = $unread_chat_message_group->count_of_unread_messages;
            }

            $chat_interlocutor = $chat_interlocutors->where('chat_id', $chat->id)->first();
            $chat->setRelation('my_interlocutor', $chat_interlocutor);
            $chat->secret_token = hash_hmac('sha256', $chat->id, 'Bobik-Chat-secret-token');

        }

        if (isset($args['business_id']) && $args['business_id']) {
            $currentUser = $this->auth->id;
            $currentManagerRole = get_manager_role($args['business_id']);

            $chats = $chats->filter(function($chat) use ($args, $currentManagerRole, $currentUser) {

                if ($firstMember = $chat->members->first()) {
                    if ($manager = $firstMember->manager) {
                        $managerRole = get_manager_role($args['business_id'], $firstMember->manager->getKey());

                        if ($currentManagerRole === Administrator::FRANCHISE_ROLE) {
                            return $manager->getKey() == $currentUser;
                        } else {
                            return $managerRole !== Administrator::FRANCHISE_ROLE;
                        }
                    }
                }

                return false;
            });

        }

        return [
            'chats' => $chats,
            'token' => $this->token,
        ];
    }
}
