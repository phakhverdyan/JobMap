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

class CountsOfInterviewRequestsQuery extends AuthQuery
{
    protected $attributes = [
        'name' => 'Counts of interview requests',
    ];

    public function type() {
        return GraphQL::type('CountsOfInterviewRequests');
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
                Administrator::MANAGER_ROLE,
                Administrator::BRANCH_ROLE,
            ], ['chats']);
        }

        $interview_request_query = \App\InterviewRequest::query();

        if (isset($args['business_id']) && $args['business_id']) {
            $interview_request_query->where('business_id', $args['business_id']);
        }
        else {
            $interview_request_query->where('user_id', $this->auth->id);
        }

        $count_of_pending = $interview_request_query->where('state', 'sent')->count();
        $interview_request_query = \App\InterviewRequest::query();

        if (isset($args['business_id']) && $args['business_id']) {
            $interview_request_query->where('business_id', $args['business_id']);
        }
        else {
            $interview_request_query->where('user_id', $this->auth->id);
        }

        $count_of_upcoming = $interview_request_query->where('state', 'accepted')->count();
        $interview_request_query = \App\InterviewRequest::query();

        if (isset($args['business_id']) && $args['business_id']) {
            $interview_request_query->where('business_id', $args['business_id']);
        }
        else {
            $interview_request_query->where('user_id', $this->auth->id);
        }

        $interview_request_query->whereIn('state', ['rejected', 'withdrawn', 'changed']);
        $count_of_archived = $interview_request_query->count();

        return [
            'pending' => $count_of_pending,
            'upcoming' => $count_of_upcoming,
            'archived' => $count_of_archived,
            'token' => $this->token,
        ];
    }
}
