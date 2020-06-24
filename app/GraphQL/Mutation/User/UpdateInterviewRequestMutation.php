<?php

namespace App\GraphQL\Mutation\User;

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

class UpdateInterviewRequestMutation extends Mutation
{
    use Auth;

    protected $attributes = [
        'name' => 'Update interview request',
    ];

    public function type()
    {
        return GraphQL::type('InterviewRequest');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'interview_request_id' => [
                'type' => Type::id(),
            ],

            'business_id' => [
                'type' => Type::int(),
            ],

            'internal_description' => [
                'type' => Type::string(),
            ],

            'external_description' => [
                'type' => Type::string(),
            ],

            'state' => [
                'type' => Type::string(),
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

        if (!$interview_request = \App\InterviewRequest::where('id', $args['interview_request_id'])->first()) {
            throw new \Exception('The interview request is not found');
        }

        if (isset($args['business_id']) && $args['business_id']) {
            if ($interview_request->business_id != $args['business_id']) {
                throw new \Exception('The interview request is not found');
            }
        }
        else {
            if ($interview_request->user_id != $this->auth->id) {
                throw new \Exception('The interview request is not found');
            }
        }

        if ($interview_request->state == 'changed') {
            throw new \Exception('The interview request has changed finite state');
        }

        if ($interview_request->state == 'finished') {
            throw new \Exception('The interview request has finished finite state');
        }

        if ($interview_request->state == 'rejected') {
            throw new \Exception('The interview request has rejected finite state');
        }

        if ($interview_request->state == 'withdrawn') {
            throw new \Exception('The interview request has withdrawn finite state');
        }

        if (!isset($args['state']) || !$args['state']) {
            throw new \Exception('The `state` argument is not set');
        }

        if (isset($args['business_id']) && $args['business_id']) {
            if ($interview_request->sender_type == 'Business') {
                if (!in_array($args['state'], ['withdrawn', 'finished'])) {
                    throw new \Exception('Wrong interview request state');
                }
            }
            else {
                if (!in_array($args['state'], ['accepted', 'rejected', 'finished'])) {
                    throw new \Exception('Wrong interview request state');
                }
            }
        }
        else {
            if ($interview_request->sender_type == 'User') {
                if (!in_array($args['state'], ['withdrawn'])) {
                    throw new \Exception('Wrong interview request state');
                }
            }
            else {
                if (!in_array($args['state'], ['accepted', 'rejected'])) {
                    throw new \Exception('Wrong interview request state');
                }
            }
        }

        if (isset($args['internal_description'])) {
            $interview_request->internal_description = trim($args['internal_description']);
        }

        if (isset($args['external_description'])) {
            $interview_request->external_description = trim($args['external_description']);
        }

        $interview_request->state = $args['state'];
        $interview_request->save();

        realtime([
            ['type' => 'User', 'id' => $interview_request->user_id],
            ['type' => 'Business', 'id' => $interview_request->business_id],
        ])->emit('interview_requests.count_updated');

        $chat_query = Chat::select('chats.*');
        $chat_query->join('chat_members AS CM0', 'chats.id', '=', 'CM0.chat_id');
        $chat_query->join('chat_members AS CM1', 'chats.id', '=', 'CM1.chat_id');
        $chat_query->where('CM0.business_id', $interview_request->business_id);
        $chat_query->where('CM1.user_id', $interview_request->user_id);

        if ($chat = $chat_query->first()) {
            $chat->load('members');
            $interview_request_chat_message = $chat->messages()->where('interview_request_id', $interview_request->id)->first();

            if ($interview_request_chat_message) {
                realtime($chat->members->map(function($chat_member) {
                    if ($chat_member->user_id) {
                        return ['type' => 'User', 'id' => $chat_member->user_id];
                    }

                    if ($chat_member->business_id) {
                        return ['type' => 'Business', 'id' => $chat_member->business_id];
                    }

                    return null;
                })->filter(function($chat_member) {
                    return $chat_member;
                })->toArray())->emit('chats.message_was_updated', [
                    'chat_id' => $chat->id,
                    'chat_message_id' => $interview_request_chat_message->id,
                ]);
            }
        }

        if ((!isset($args['business_id']) || !$args['business_id']) && $args['state'] == 'accepted') {
            $candidate_query = \App\Candidate\Candidate::query();
            $candidate_query->where('business_id', $interview_request->business_id);
            $candidate_query->where('user_id', $interview_request->user_id);

            if ($candidate = $candidate_query->first()) {
                if ($pipeline = \App\Business\Pipeline::where('business_id', $interview_request->business_id)->where('type_new', 'to_interview')->first()) {
                    $candidate->pipeline = $pipeline->id;
                    $candidate->save();
                }
            }
        }

        if (!isset($args['business_id']) || !$args['business_id']) {
            if ($interview_request->sender_type == 'Business') {
                if ($interview_request->state == 'accepted') {
                    if ($with_user = \App\User::where('id', $interview_request->user_id)->first()) {
                        Mail::to($with_user->email)->queue(new \App\Mail\UserInterview(
                            $interview_request,
                            $interview_request->user,
                            $interview_request->business,
                            'ACCEPTED',
                            $this->auth->language_prefix
                        ));

                        Mail::to($interview_request->business->admin->user->email)->queue(new \App\Mail\BusinessInterview(
                            $interview_request,
                            $interview_request->user,
                            $interview_request->business,
                            $interview_request->business->admin->user,
                            'ACCEPTED',
                            $this->auth->language_prefix
                        ));
                    }
                }
            }
        }

        $interview_request->token = $this->token;
        return $interview_request;
    }
}
