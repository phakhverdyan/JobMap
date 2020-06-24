<?php
/**
 * Created by PhpStorm.
 * User: alexey
 * Date: 07.03.18
 * Time: 15:52
 */

namespace App\GraphQL\Query\User;

use App\User;
use App\GraphQL\Extensions\AuthQuery;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
//use App\GraphQL\Query\User\Auth\DB;
use Illuminate\Support\Facades\DB;
use App\Business\Administrator;

class InterviewRequestsQuery extends AuthQuery
{
    protected $attributes = [
        'name' => 'List of interview requests',
    ];

    public function type() {
        return GraphQL::type('InterviewRequests');
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

            'after_id' => [
                'type' => Type::int(),
                'description' => 'The interview request ID after which it returns interview requests (not included `after_id` itself) (optional) (ordering by ID ascend)',
            ],

            'before_id' => [
                'type' => Type::int(),
                'description' => 'The interview request ID before which it returns interview requests (not included `before_id` itself`) (optional) (ordering by ID ascend)'
            ],

            'count' => [
                'type' => Type::int(),
                'description' => 'Count of interview requests to return (optional, default: 10)',
            ],

            'type' => [
                'type' => Type::string(),
                'description' => 'Type of the interview request (optional)',
            ],

            // 'text' => [
            //     'type' => Type::string(),
            //     'description' => 'Text for search messages (optional)',
            // ],

            // 'ordering' => [
            //     'type' => Type::string(),
            //     'description' => 'Ordering of interview requests to get.',
            // ],
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args) {

        // FRENCHASEE

        if (isset($args['business_id']) && $args['business_id']) {
            $this->checkBusinessAccess($args['business_id'], [
                Administrator::MANAGER_ROLE,
                Administrator::BRANCH_ROLE,
            ]);
        }

        $isFranchise = get_manager_role($args['business_id']) === Administrator::FRANCHISE_ROLE;

        $interview_request_query = \App\InterviewRequest::query();

        if (isset($args['business_id']) && $args['business_id']) {
            $interview_request_query->where('business_id', $args['business_id']);
            if ($isFranchise) {
                $interview_request_query->where('manager_user_id', $this->auth->id);
            }
        }
        else {
            $interview_request_query->where('user_id', $this->auth->id);
        }

        $count_of_pending = $interview_request_query->where('state', 'sent')->count();
        $interview_request_query = \App\InterviewRequest::query();

        if (isset($args['business_id']) && $args['business_id']) {
            $interview_request_query->where('business_id', $args['business_id']);
            if ($isFranchise) {
                $interview_request_query->where('manager_user_id', $this->auth->id);
            }
        }
        else {
            $interview_request_query->where('user_id', $this->auth->id);
        }

        $count_of_upcoming = $interview_request_query->where('state', 'accepted')->count();
        $interview_request_query = \App\InterviewRequest::query();

        if (isset($args['business_id']) && $args['business_id']) {
            $interview_request_query->where('business_id', $args['business_id']);
            if ($isFranchise) {
                $interview_request_query->where('manager_user_id', $this->auth->id);
            }
        }
        else {
            $interview_request_query->where('user_id', $this->auth->id);
        }

        $interview_request_query->whereIn('state', ['rejected', 'withdrawn', 'changed']);
        $count_of_archived = $interview_request_query->count();
        $interview_request_query = \App\InterviewRequest::query();

        if (isset($args['business_id']) && $args['business_id']) {
            $interview_request_query->where('business_id', $args['business_id']);
            if ($isFranchise) {
                $interview_request_query->where('manager_user_id', $this->auth->id);
            }
        }
        else {
            $interview_request_query->where('user_id', $this->auth->id);
        }

        $total_count = $interview_request_query->count();
        $interview_request_query = \App\InterviewRequest::query();

        if (isset($args['business_id']) && $args['business_id']) {
            $interview_request_query->where('business_id', $args['business_id']);
            if ($isFranchise) {
                $interview_request_query->where('manager_user_id', $this->auth->id);
            }
        }
        else {
            $interview_request_query->where('user_id', $this->auth->id);
        }

        $after_id = isset($args['after_id']) ? (int) $args['after_id'] : 0;
        $before_id = isset($args['before_id']) ? (int) $args['before_id'] : 0;
        $ordering = isset($args['ordering']) ? $args['ordering'] : null;
        $ordering = in_array($ordering, [ 'asc', 'desc' ]) ? $ordering : null;
        $count = isset($args['count']) ? (int) $args['count'] : 10;
        $count = min(max($count, 1), 100);

        // $before_chat_message_query = $chat->messages();
        // $chat_message_query = $interview_request_query->get();
        // $after_chat_message_query = $chat->messages();

        if ($after_id && $before_id) {
            $interview_request_query->where('id', '>', $after_id)->where('id', '<', $before_id)->orderBy('id', $ordering ? $ordering : 'asc');
        }
        elseif ($after_id) {
            $interview_request_query->where('id', '>', $after_id)->orderBy('id', 'asc');
        }
        elseif ($before_id) {
            $interview_request_query->where('id', '<', $before_id)->orderBy('id', 'desc');
        }
        else {
            $interview_request_query->orderBy('id', $ordering ? $ordering : 'desc');
        }

        $current_type = '';

        if (isset($args['type']) && $args['type']) {
            if ($args['type'] == 'upcoming') {
                $interview_request_query->where('state', 'accepted');
                $current_type = 'upcoming';
            }
            else if ($args['type'] == 'pending') {
                $interview_request_query->where('state', 'sent');
                $current_type = 'pending';
            }
            else if ($args['type'] == 'archived') {
                $interview_request_query->whereIn('state', ['rejected', 'withdrawn', 'changed']);
                $current_type = 'archived';
            }
            else if ($args['type'] == 'first_where_count_is_not_zero') {
                if ($count_of_pending > 0) {
                    $interview_request_query->where('state', 'sent');
                    $current_type = 'pending';
                }
                else if ($count_of_upcoming > 0) {
                    $interview_request_query->where('state', 'accepted');
                    $current_type = 'accepted';
                }
                else if ($count_of_archived > 0) {
                    $interview_request_query->whereIn('state', ['rejected', 'withdrawn', 'changed']);
                    $current_type = 'archived';
                }
                else {
                    $interview_request_query->where('state', 'sent');
                    $current_type = 'pending';
                }
            }
        }

        // $count_of_chat_messages_before = 0;
        // $count_of_chat_messages_after = 0;

        // $chat_message_query->with('interlocutor', 'interlocutor.user', 'interlocutor.business');
        // $chat_message_query->with('member', 'member.user', 'member.business');

        // $chat_message_query->with(['read_interlocutors' => function($query) use ($chat_interlocutor) {
        //     if ($chat_interlocutor) {
        //         $query->where('id', '!=', $chat_interlocutor->id);
        //     }
        // }, 'read_interlocutors.user', 'read_interlocutors.business']);

        // $chat_message_query->with('interview_request');
        //

        $interview_requests = $interview_request_query->take($count)->get()->sortBy('id')->values();

        // if ($before_id && $after_id) {
        //     if ($chat_messages->count() > 0) {
        //         $count_of_chat_messages_before = $before_chat_message_query->where('id', '<', $chat_messages->first()->id)->count();
        //         $count_of_chat_messages_after = $after_chat_message_query->where('id', '>', $chat_messages->last()->id)->count();
        //     }
        //     else {
        //         $count_of_chat_messages_before = $before_chat_message_query->where('id', '<=', $after_id)->count();
        //         $count_of_chat_messages_after = $after_chat_message_query->where('id', '>=', $before_id)->count();
        //     }
        // }
        // elseif ($after_id) {
        //     $count_of_chat_messages_before = $before_chat_message_query->where('id', '<=', $after_id)->count();

        //     if ($chat_messages->count() >= $count) {
        //         $count_of_chat_messages_after = $after_chat_message_query->where('id', '>', $chat_messages->last()->id)->count();
        //     }
        // }
        // elseif ($before_id) {
        //     if ($chat_messages->count() >= $count) {
        //         $count_of_chat_messages_before = $before_chat_message_query->where('id', '<', $chat_messages->first()->id)->count();
        //     }

        //     $count_of_chat_messages_after = $after_chat_message_query->where('id', '>=', $before_id)->count();
        // }
        // else {
        //     if ($chat_messages->count() >= $count) {
        //         $count_of_chat_messages_before = $before_chat_message_query->where('id', '<', $chat_messages->first()->id)->count();
        //         $count_of_chat_messages_after = $after_chat_message_query->where('id', '>', $chat_messages->last()->id)->count();
        //     }
        // }

        // foreach ($chat_messages as $chat_message) {
        //     $chat_message->state = ($chat_message->id <= $chat->last_read_message_id ? 'read' : 'sent');
        // }

        return [
            // 'count_of_chat_messages_before' => $count_of_chat_messages_before,
            'interview_requests' => $interview_requests,
            // 'count_of_chat_messages_after' => $count_of_chat_messages_after,

            'count_of_pending'      => $count_of_pending,
            'count_of_upcoming'     => $count_of_upcoming,
            'count_of_archived'     => $count_of_archived,
            'total_count'           => $total_count,
            'current_type'          => $current_type,
            'token'                 => $this->token,
        ];
    }
}
