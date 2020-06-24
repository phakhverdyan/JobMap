<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Http\Resources\BaseCollectionResource;
use App\Business\Administrator;
use App\Chat;
use App\ChatMessage;
use App\ChatInterlocutor;
use App\User;

class UserChatController extends Controller
{
    public function list(Request $request, $user_id)
    {
    	$user = ($user_id == 'me') ? auth()->user() : User::where('id', $user_id)->firstOrFail();

    	// ---------------------------------------------------------------------- //

     // if ($request->input('business_id')) {
     //        $this->checkBusinessAccess($request->input('business_id'), [
     //            Administrator::MANAGER_ROLE,
     //            Administrator::BRANCH_ROLE,
     //        ], ['chats']);
     //    }

        $before_last_message_id = (int) $request->input('before_last_message_id', 0);
        $count = (int) $request->input('before_last_message_id', 10);
        $count = min(max($count, 1), 100);

        $chat_query = Chat::where('chats.last_message_id', '>', 0);

        if ($before_last_message_id > 0) {
            $chat_query->where('chats.last_message_id', '<', $before_last_message_id);
        }

        $chat_query->join('chat_members AS CM0', 'chats.id', '=', 'CM0.chat_id');
        $isJoinUsers = false;

        if ($request->input('business_id')) {
            $chat_query->where('CM0.business_id', $request->input('business_id'));
            $chat_query->where('CM0.manager_id', $user->id);

            if ($request->input('name')) {
                $chat_query->join('chat_members AS CM1', 'chats.id', '=', 'CM1.chat_id');
                $chat_query->join('users', 'users.id', '=', 'CM1.user_id');
                $isJoinUsers = true;

                if (stristr($request->input('name'), ' ') !== FALSE) {
                    list($name1, $name2) = explode(' ', $request->input('name'));

                    /*$chat_query->where([
                        ['users.first_name', 'like', '%' . trim($name1) . '%'],
                        ['users.last_name', 'like', '%' . trim($name2) . '%'],
                        ['users.first_name', 'like', '%' . trim($name2) . '%'],
                        ['users.last_name', 'like', '%' . trim($name1) . '%'],
                    ]);*/
                    $chat_query->where(function ($q) use ($name1, $name2) {
                        $where->where('users.first_name', 'like', '%' . trim($name1) . '%');
                        $where->orWhere('users.last_name', 'like', '%' . trim($name2) . '%');
                        $where->orWhere('users.first_name', 'like', '%' . trim($name2) . '%');
                        $where->orWhere('users.last_name', 'like', '%' . trim($name1) . '%');
                    });
                } else {
                    /*$chat_query->where([
                        ['users.first_name', 'like', '%' . trim($args['name']) . '%'],
                        ['users.last_name', 'like', '%' . trim($args['name']) . '%'],
                    ]);*/
                    $chat_query->where(function ($where) use ($request) {
                        $where->where('users.first_name', 'like', '%' . trim($request->input('name')) . '%');
                        $where->orWhere('users.last_name', 'like', '%' . trim($request->input('name')) . '%');
                    });
                }
            }
        } else {
            $chat_query->where('CM0.user_id', $user->id);

            if ($request->input('name')) {
                $chat_query->join('chat_members AS CM1', 'chats.id', '=', 'CM1.chat_id');
                $chat_query->join('businesses', 'businesses.id', '=', 'CM1.business_id');
                $chat_query->where('businesses.name', 'like', '%' . trim($request->input('name')) . '%');
            }
        }

        if ($request->input('business_id')) {
            if (get_manager_role($request->input('business_id'), $user->id) === Administrator::FRANCHISE_ROLE) {
                $chat_query->where('CM0.manager_id', $user->id);
            }
        }

        if ($request->input('filtering_manager_ids') && count($request->input('filtering_manager_ids')) > 0) {
            $chat_query->join('chat_interlocutors', 'chat_interlocutors.chat_id', '=', 'chats.id');
            $chat_query->whereIn('chat_interlocutors.user_id', $request->input('filtering_manager_ids'));
            $chat_query->distinct();
        }

        if ($request->input('filtering_city_region') && count($request->input('filtering_city_region')) > 0) {
            if (!$isJoinUsers) {
                $chat_query->join('chat_members AS CM1', 'chats.id', '=', 'CM1.chat_id');
                $chat_query->join('users', 'users.id', '=', 'CM1.user_id');
            }

            $values = $request->input('filtering_city_region');

            $chat_query->where(function ($query) use ($values) {
                foreach ($values as $value) {
                    $vals = explode('---', $value);

                    $query->orWhere(function ($query) use ($vals) {
                        if ($vals[1] == 'y') {
                            $vs = explode(',', $vals[0]);

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

        $chat_query->with([
			'last_message',
			'last_message.interlocutor',
			'last_message.interlocutor.user',
			'last_message.interlocutor.business',
			'members',
			'members.user',
			'members.business',
		]);

        $chat_query->orderBy('chats.last_message_id', 'desc');
        $chat_query->limit($count);
        $chats = $chat_query->get();

        $chat_message_query = ChatMessage::query();

        $chat_message_query->leftJoin('chat_interlocutors', function($join) use ($request, $user) {
            $join->on('chat_interlocutors.chat_id', '=', 'chat_messages.chat_id');

            if ($request->input('business_id')) {
                $join->on('chat_interlocutors.user_id', '=', DB::raw($user->id));
                $join->on('chat_interlocutors.business_id', '=', DB::raw($request->input('business_id')));
            } else {
                $join->on('chat_interlocutors.user_id', '=', DB::raw($user->id));
                $join->on('chat_interlocutors.business_id', '=', DB::raw(0));
            }
        });

        $chat_message_query->whereIn('chat_messages.chat_id', $chats->pluck('id')->toArray());
        $chat_message_query->whereRaw('chat_messages.id > IFNULL(chat_interlocutors.last_read_message_id, 0)');
        $chat_message_query->select('chat_messages.chat_id', DB::raw('COUNT(*) AS count_of_unread_messages'));
        $unread_chat_message_groups = $chat_message_query->groupBy('chat_messages.chat_id')->get();

        $chat_interlocutors = ChatInterlocutor::whereIn('chat_id', $chats->pluck('id')->toArray())
            ->where('user_id', $user->id)
            ->where('business_id', $request->input('business_id', 0))
            ->get();

        foreach ($chats as $chat) {
            if (!$chat->is_group) {
                if ($request->input('business_id')) {
                    $chat->setRelation('opposite_member', $chat->members->where('business_id', '!=', $request->input('business_id'))->first());
                } else {
                    $chat->setRelation('opposite_member', $chat->members->where('user_id', '!=', $user->id)->first());
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

        if ($request->input('business_id')) {
            $currentUser = $user->id;
            $currentManagerRole = get_manager_role($request->input('business_id'), $user->id);

            $chats = $chats->filter(function($chat) use ($request, $currentManagerRole, $currentUser) {

                if ($firstMember = $chat->members->first()) {
                    if ($manager = $firstMember->manager) {
                        $managerRole = get_manager_role($request->input('business_id'), $firstMember->manager->getKey());

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

        return new BaseCollectionResource($chats);
    }

    public function get(Request $request, $user_id, $chat_id)
    {
    	$user = ($user_id == 'me') ? auth()->user() : User::where('id', $user_id)->firstOrFail();
    	$chat_query = Chat::query();
    	$chat_query->where('id', $chat_id);
    	
    	$chat_query->with([
			'last_message',
			'last_message.interlocutor',
			'last_message.interlocutor.user',
			'last_message.interlocutor.business',
			'members',
			'members.user',
			'members.business',
		]);

    	$chat = $chat_query->firstOrFail();

    	// if (isset($args['business_id']) && $args['business_id']) {
     //        // if (!$chat->members()->where('business_id', $args['business_id'])->first()) {
     //        //     throw new \Exception('Permission error.');
     //        // }
     //    } else {
     //        if (!$chat->members()->where('user_id', $user->id)->first()) {
     //            throw new \Exception('Permission error.');
     //        }
     //    }

        $chat_message_query = ChatMessage::query();
        $chat_message_query->join('chat_members', 'chat_members.chat_id', '=', 'chat_messages.chat_id');

        $chat_message_query->leftJoin('chat_interlocutors', function($join) use ($request, $user) {
            $join->on('chat_interlocutors.chat_id', '=', 'chat_messages.chat_id');

            if ($request->input('business_id')) {
                $join->on('chat_interlocutors.business_id', '=', DB::raw($request->input('business_id')));
            } else {
                $join->on('chat_interlocutors.user_id', '=', DB::raw($user->id));
                $join->on('chat_interlocutors.business_id', '=', DB::raw(0));
            }
        });

        if ($request->input('business_id')) {
            $chat_message_query->where('chat_members.business_id', $request->input('business_id'));
            $chat_message_query->where('chat_members.manager_id', $user->id);
        } else {
            $chat_message_query->where('chat_members.user_id', $user->id);
        }

        $chat_message_query->where('chat_messages.chat_id', $chat->id);
        $chat_message_query->whereRaw('chat_messages.id > IFNULL(chat_interlocutors.last_read_message_id, 0)');
        $chat->count_of_unread_messages = $chat_message_query->count();
        $chat->secret_token = hash_hmac('sha256', $chat->id, 'Bobik-Chat-secret-token');

        return (new BaseResource($chat));
    }

    public function messages(Request $request, $user_id, $chat_id)
    {
    	$user = ($user_id == 'me') ? auth()->user() : User::where('id', $user_id)->firstOrFail();

    	// if (isset($args['business_id']) && $args['business_id']) {
     //        $this->checkBusinessAccess($args['business_id'], [
     //            \App\Business\Administrator::MANAGER_ROLE,
     //            \App\Business\Administrator::BRANCH_ROLE,
     //        ], ['chats']);
     //    }

        $chat = Chat::where('id', $chat_id)->firstOrFail();

        if ($request->input('business_id')) {
            if (!$chat->members()->where('business_id', $request->input('business_id'))->first()) {
                abort(403);
            }
        } else {
            if (!$chat->members()->where('user_id', $user->id)->first()) {
                abort(403);
            }
        }

        $chat_interlocutor_query = $chat->interlocutors();
        $chat_interlocutor_query->where('user_id', $user->id);
        $chat_interlocutor_query->where('business_id', $request->input('business_id', 0));
        $chat_interlocutor = $chat_interlocutor_query->first();

        $after_id = (int) $request->input('after_id', 0);
        $around_id = (int) $request->input('around_id', 0);
        $before_id = (int) $request->input('before_id', 0);
        $ordering = $request->input('ordering');
        $ordering = in_array($ordering, ['asc', 'desc']) ? $ordering : null;
        $count = (int) $request->input('count', 10);
        $count = min(max($count, 1), 100);

        $before_chat_message_query = $chat->messages();
        $chat_message_query = $chat->messages();
        $after_chat_message_query = $chat->messages();

        if ($around_id) {
            $chat_message_query->where('id', $around_id);
        } elseif ($after_id && $before_id) {
            $chat_message_query->where('id', '>', $after_id)->where('id', '<', $before_id)->orderBy('id', $ordering ? $ordering : 'asc');
        } elseif ($after_id) {
            $chat_message_query->where('id', '>', $after_id)->orderBy('id', 'asc');
        } elseif ($before_id) {
            $chat_message_query->where('id', '<', $before_id)->orderBy('id', 'desc');
        } else {
            $chat_message_query->orderBy('id', $ordering ? $ordering : 'desc');
        }

        if (!$around_id) {
            if ($request->input('text')) {
                $before_chat_message_query->where('text', 'like', '%' . trim($request->input('text')) . '%');
                $chat_message_query->where('text', 'like', '%' . trim($request->input('text')) . '%');
                $after_chat_message_query->where('text', 'like', '%' . trim($request->input('text')) . '%');
            }
        }

        $count_of_chat_messages_before = 0;
        $count_of_chat_messages_after = 0;

        if ($around_id) {
            $chat_message_query->with([
            	'interlocutor',
            	'interlocutor.user',
            	'interlocutor.business',
            ]);

            $chat_message_query->with([
            	'member',
            	'member.user',
            	'member.business',
            ]);

            $chat_message_query->with([
            	'read_interlocutors' => function($query) use ($chat_interlocutor) {
	                if ($chat_interlocutor) {
	                    $query->where('id', '!=', $chat_interlocutor->id);
	                }
	            },

	            'read_interlocutors.user',
	            'read_interlocutors.business',
	        ]);

            $chat_message_query->with('interview_request');
            $middle_chat_message = $chat_message_query->first();

            $before_chat_messages = $chat->messages()->with([
                	'interlocutor',
                	'interlocutor.user',
                	'interlocutor.business',
                ])->with([
                	'member',
                	'member.user',
                	'member.business',
                ])->with(['read_interlocutors' => function($query) use ($chat_interlocutor) {
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

            $after_chat_messages = $chat->messages()->with([
            	'interlocutor',
            	'interlocutor.user',
            	'interlocutor.business',
            ])->with([
            	'member',
            	'member.user',
            	'member.business',
            ])->with([
            	'read_interlocutors' => function($query) use ($chat_interlocutor) {
                    if ($chat_interlocutor) {
                        $query->where('id', '!=', $chat_interlocutor->id);
                    }
                },

                'read_interlocutors.user',
                'read_interlocutors.business',
            ])->with('interview_request')
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
        } else {
            $chat_message_query->with([
            	'interlocutor',
            	'interlocutor.user',
            	'interlocutor.business',
            ]);

            $chat_message_query->with([
            	'member',
            	'member.user',
            	'member.business',
            ]);

            $chat_message_query->with([
            	'read_interlocutors' => function($query) use ($chat_interlocutor) {
	                if ($chat_interlocutor) {
	                    $query->where('id', '!=', $chat_interlocutor->id);
	                }
	            },

	            'read_interlocutors.user',
	            'read_interlocutors.business',
			]);

            $chat_message_query->with([
            	'interview_request',
            ]);

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
            } elseif ($after_id) {
                $count_of_chat_messages_before = $before_chat_message_query->where('id', '<=', $after_id)->count();

                if ($chat_messages->count() >= $count) {
                    $count_of_chat_messages_after = $after_chat_message_query->where('id', '>', $chat_messages->last()->id)->count();
                }
            } elseif ($before_id) {
                if ($chat_messages->count() >= $count) {
                    $count_of_chat_messages_before = $before_chat_message_query->where('id', '<', $chat_messages->first()->id)->count();
                }

                $count_of_chat_messages_after = $after_chat_message_query->where('id', '>=', $before_id)->count();
            } else {
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
        ];
    }

    public function countOfUnreadMessages(Request $request, $user_id, $chat_id = null)
    {
    	$user = ($user_id == 'me') ? auth()->user() : User::where('id', $user_id)->firstOrFail();

    	// if (isset($args['business_id']) && $args['business_id']) {
     //        $this->checkBusinessAccess($args['business_id'], [
     //            \App\Business\Administrator::MANAGER_ROLE,
     //            \App\Business\Administrator::BRANCH_ROLE,
     //        ], ['chats']);
     //    }

        $chat_message_query = ChatMessage::query();
        $chat_message_query->join('chat_members', 'chat_members.chat_id', '=', 'chat_messages.chat_id');

        $chat_message_query->leftJoin('chat_interlocutors', function($join) use ($user, $request) {
            $join->on('chat_interlocutors.chat_id', '=', 'chat_messages.chat_id');

            if ($request->input('business_id')) {
                $join->on('chat_interlocutors.user_id', '=', DB::raw($user->id));
                $join->on('chat_interlocutors.business_id', '=', DB::raw($request->input('business_id')));
            } else {
                $join->on('chat_interlocutors.user_id', '=', DB::raw($user->id));
                $join->on('chat_interlocutors.business_id', '=', DB::raw(0));
            }
        });

        if ($request->input('business_id')) {
            $chat_message_query->where('chat_members.business_id', $request->input('business_id'));
            $chat_message_query->where('chat_members.manager_id', $user->id);
        } else {
            $chat_message_query->where('chat_members.user_id', $user->id);
        }

        $chat_message_query->whereRaw('chat_messages.id > IFNULL(chat_interlocutors.last_read_message_id, 0)');
        $total_count = $chat_message_query->count();
        $count = null;

        if ($chat_id) {
            $chat_message_query = ChatMessage::query();
            $chat_message_query->join('chat_members', 'chat_members.chat_id', '=', 'chat_messages.chat_id');

            $chat_message_query->leftJoin('chat_interlocutors', function($join) use ($user, $request) {
                $join->on('chat_interlocutors.chat_id', '=', 'chat_messages.chat_id');

                if ($request->input('business_id')) {
                    $join->on('chat_interlocutors.user_id', '=', DB::raw($user->id));
                    $join->on('chat_interlocutors.business_id', '=', DB::raw($request->input('business_id')));
                } else {
                    $join->on('chat_interlocutors.user_id', '=', DB::raw($user->id));
                    $join->on('chat_interlocutors.business_id', '=', DB::raw(0));
                }
            });

            if ($request->input('business_id')) {
                $chat_message_query->where('chat_members.business_id', $request->input('business_id'));
                $chat_message_query->where('chat_members.manager_id', $user->id);
            } else {
                $chat_message_query->where('chat_members.user_id', $user->id);
            }

            $chat_message_query->where('chat_messages.chat_id', $chat_id);
            $chat_message_query->whereRaw('chat_messages.id > IFNULL(chat_interlocutors.last_read_message_id, 0)');
            $count = $chat_message_query->count();
        }

        return [
            'total_count' => $total_count,
            'count' => $count,
        ];
    }

    public function createMessage(Request $request, $user_id, $chat_id)
    {
    	$user = ($user_id == 'me') ? auth()->user() : User::where('id', $user_id)->firstOrFail();

    	// if (isset($args['business_id']) && $args['business_id']) {
     //        $this->checkBusinessAccess($args['business_id'], [
     //            \App\Business\Administrator::MANAGER_ROLE,
     //            \App\Business\Administrator::BRANCH_ROLE,
     //        ], ['chats']);
     //    }

        $authManagerRole = false;
        $chat = Chat::where('id', $chat_id)->firstOrFail();
        $chat_members = $chat->members()->get();

        if ($request->input('business_id')) {
            $authManagerRole = get_manager_role($request->input('business_id'));

            if (!$chat_member = $chat_members->where('business_id', $request->input('business_id'))->first()) {
                abort(403);
            }
        }
        else {
            if (!$chat_member = $chat_members->where('user_id', $user->id)->first()) {
                abort(403);
            }
        }

        if (!$request->input('chat_message.text') || !trim($request->input('chat_message.text'))) {
            return response([
            	'error' => 'Text Cannot Be Empty',
            ], 400);
        }

        $chat_interlocutor = $chat->interlocutors()
            ->where('user_id', $user->id)
            ->where('business_id', $request->input('business_id', 0))
            ->first();

        if (!$chat_interlocutor) {
            $chat_interlocutor = new ChatInterlocutor;
            $chat_interlocutor->chat_id = $chat->id;
            $chat_interlocutor->user_id = $user->id;

            if ($authManagerRole && $authManagerRole === Administrator::FRANCHISE_ROLE) {
                $chat_interlocutor->manager_id = $user->id;
            }

            $chat_interlocutor->business_id = $request->input('business_id', 0);
            $chat_interlocutor->last_read_message_id = 0;
            $chat_interlocutor->save();
        }

        $chat_member->load(['user', 'business']);
        $chat_interlocutor->load(['user', 'business']);
        $chat_message = new ChatMessage;
        $chat_message->chat_id = $chat->id;
        $chat_message->text = trim($request->input('chat_message.text'));
        $chat_message->interlocutor_id = $chat_interlocutor->id;

        if ($authManagerRole && $authManagerRole === Administrator::FRANCHISE_ROLE) {
            $chat_message->manager_id = $user->id;
        }

        $chat_message->setRelation('interlocutor', $chat_interlocutor);
        $chat_message->member_id = $chat_member->id;
        $chat_message->setRelation('member', $chat_member);

        if ($chat_member->business_id > 0 && $chat->last_message_id == 0) { // if sender IS business AND it is the FIRST message
            $chat_members->where('user_id', '>', 0)->each(function($current_chat_member) use ($chat_message, $chat_member) {
                Mail::to($current_chat_member->user->email)->queue(new \App\Mail\UserNewMessage(
                    $current_chat_member->user,
                    $chat_member->business,
                    'INITIAL',
                    auth()->user()->language_prefix
                ));
            });
        }

        DB::transaction(function() use ($chat, $chat_message, $chat_interlocutor) {
            $chat_message->save();
            $chat->last_message_id = $chat_message->id;
            $chat->save();
            $chat_interlocutor->last_read_message_id = $chat_message->id;
            $chat_interlocutor->save();
        });

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
        })->toArray())->emit('chats.message_was_created', [
            'chat_id' => $chat->id,
            'chat_message_id' => $chat_message->id,
            'interlocutor_id' => $chat_interlocutor->id,
        ]);

        return (new BaseResource($chat_message));
    }

    public function getMessage(Request $request, $user_id, $chat_id, $message_id)
    {
    	$user = ($user_id == 'me') ? auth()->user() : User::where('id', $user_id)->firstOrFail();

    	// if (isset($args['business_id']) && $args['business_id']) {
     //        $this->checkBusinessAccess($args['business_id'], [
     //            \App\Business\Administrator::MANAGER_ROLE,
     //            \App\Business\Administrator::BRANCH_ROLE,
     //        ], ['chats']);
     //    }

        $chat = Chat::where('id', $chat_id)->firstOrFail();

        if ($request->input('business_id')) {
            if (!$chat->members()->where('business_id', $request->input('business_id'))->first()) {
                abort(403);
            }
        } else {
            if (!$chat->members()->where('user_id', $user->id)->first()) {
                abort(403);
            }
        }

        $chat_message = $chat->messages()->where('id', $message_id)->firstOrFail();

        $chat_interlocutor = $chat->interlocutors()
            ->where('user_id', $user->id)
            ->where('business_id', $request->input('business_id', 0))
            ->first();

        $chat_message->load([
        	'interlocutor',
        	'interlocutor.user',
        	'interlocutor.business',
        ]);

        $chat_message->load([
        	'member',
        	'member.user',
        	'member.business',
        ]);

        $chat_message->load([
        	'read_interlocutors' => function($query) use ($chat_interlocutor) {
	            if ($chat_interlocutor) {
	                $query->where('id', '!=', $chat_interlocutor->id);
	            }
	        },

	        'read_interlocutors.user',
	        'read_interlocutors.business',
	    ]);

        $chat_message->load(['interview_request']);
        $chat_message->state = ($chat_message->id <= $chat->last_read_message_id ? 'read' : 'sent');

        return (new BaseResource($chat_message));
    }

    public function getInterlocutor(Request $request, $user_id, $chat_id, $interlocutor_id)
    {
    	$user = ($user_id == 'me') ? auth()->user() : User::where('id', $user_id)->firstOrFail();

    	// if (isset($args['business_id']) && $args['business_id']) {
     //        $this->checkBusinessAccess($args['business_id'], [
     //            \App\Business\Administrator::MANAGER_ROLE,
     //            \App\Business\Administrator::BRANCH_ROLE,
     //        ], ['chats']);
     //    }
        
        $chat = Chat::where('id', $chat_id)->firstOrFail();

        if ($request->input('business_id')) {
            if (!$chat->members()->where('business_id', $request->input('business_id'))->first()) {
                abort(403);
            }
        } else {
            if (!$chat->members()->where('user_id', $user->id)->first()) {
                abort(403);
            }
        }

        $chat_interlocutor = $chat->interlocutors()->where('id', $interlocutor_id)->firstOrFail();
        $chat_interlocutor->load(['user', 'business']);
        
        return (new BaseResource($chat_interlocutor));
    }

    public function updateMyInterlocutor(Request $request, $user_id, $chat_id)
    {
    	$user = ($user_id == 'me') ? auth()->user() : User::where('id', $user_id)->firstOrFail();

    	// if (isset($args['business_id']) && $args['business_id']) {
     //        $this->checkBusinessAccess($args['business_id'], [
     //            \App\Business\Administrator::MANAGER_ROLE,
     //            \App\Business\Administrator::BRANCH_ROLE,
     //        ], ['chats']);
     //    }

        $chat = Chat::where('id', $chat_id)->firstOrFail();
        $chat_members = $chat->members()->get();

        if ($request->input('business_id')) {
            $chat_member = $chat_members->where('business_id', $request->input('business_id'))->first();
        } else {
            $chat_member = $chat_members->where('user_id', $user->id)->first();
        }

        if (!$chat_member) {
            abort(403);
        }

        $chat_interlocutor = $chat->interlocutors()
            ->where('user_id', $user->id)
            ->where('business_id', $request->input('business_id', 0))
            ->first();

        if (!$chat_interlocutor) {
            $chat_interlocutor = new ChatInterlocutor;
            $chat_interlocutor->chat_id = $chat->id;
            $chat_interlocutor->user_id = $user->id;
            $chat_interlocutor->business_id = $request->input('business_id', 0);
            $chat_interlocutor->last_read_message_id = 0;
            $chat_interlocutor->save();
        }

        if ($request->input('chat_interlocutor.last_read_message_id')) {
            if (!$last_read_chat_message = $chat->messages()->where('id', $request->input('chat_interlocutor.last_read_message_id'))->first()) {
            	return response([
            		'error' => 'Last Read Message Not Found',
            	], 400);
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

        return (new BaseResource($chat_interlocutor));
    }

    public function emitTyping(Request $request, $user_id, $chat_id)
    {
    	$user = ($user_id == 'me') ? auth()->user() : User::where('id', $user_id)->firstOrFail();

    	// if (isset($args['business_id']) && $args['business_id']) {
     //        $this->checkBusinessAccess($args['business_id'], [
     //            \App\Business\Administrator::MANAGER_ROLE,
     //            \App\Business\Administrator::BRANCH_ROLE,
     //        ], ['chats']);
     //    }

        $chat = Chat::where('id', $chat_id)->firstOrFail();
        $chat_members = $chat->members()->get();

        if ($request->input('business_id')) {
            if (!$chat_members->where('business_id', $request->input('business_id'))->first()) {
                abort(403);
            }
        } else {
            if (!$chat_members->where('user_id', $user->id)->first()) {
                abort(403);
            }
        }

        $chat_interlocutor = $chat->interlocutors()
            ->where('user_id', $user->id)
            ->where('business_id', $request->input('business_id', 0))
            ->first();

        if (!$chat_interlocutor) {
            $chat_interlocutor = new ChatInterlocutor;
            $chat_interlocutor->chat_id = $chat->id;
            $chat_interlocutor->user_id = $user->id;
            $chat_interlocutor->business_id = $request->input('business_id', 0);
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

    	return (new BaseResource($chat_interlocutor));
    }
}
