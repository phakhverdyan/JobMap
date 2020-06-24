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

class CreateInterviewRequestMutation extends Mutation
{
    use Auth;

    protected $attributes = [
        'name' => 'Create new interview request',
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
            'previous_interview_request_id' => [
                'type' => Type::id(),
            ],

            'with_user_id' => [
                'type' => Type::id(),
            ],

            'with_business_id' => [
                'type' => Type::id(),
            ],

            'business_id' => [
                'type' => Type::id(),
            ],

            'type' => [
                'type' => Type::string(),
            ],

            'phone_number' => [
                'type' => Type::string(),
            ],

            'address' => [
                'type' => Type::string(),
            ],

            'messenger_identifier' => [
                'type' => Type::string(),
            ],

            'interviewer_name' => [
                'type' => Type::string(),
            ],

            'state' => [
                'type' => Type::string(),
            ],

            'date' => [
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

        $business = null;

        if (isset($args['business_id']) && $args['business_id']) {
            $business = \App\Business::where('id', $args['business_id'])->first();
        }

        $with_business = null;
        $with_user = null;

        if (isset($args['business_id']) && $args['business_id']) {
            if (!isset($args['with_user_id']) && !$args['with_user_id']) {
                throw new \Exception('Argument `with_user_id` not set');
            }

            if (!$with_user = \App\User::where('id', $args['with_user_id'])->first()) {
                throw new \Exception('The user `with_user_id` is not found');
            }
        }
        else {
            if (!isset($args['with_business_id']) && !$args['with_business_id']) {
                throw new \Exception('Argument `with_business_id` not set');
            }

            if (!$with_business = \App\Business::where('id', $args['with_business_id'])->first()) {
                throw new \Exception('The business `with_business_id` is not found');
            }
        }

        $last_interview_request = \App\InterviewRequest::query()
            ->where('business_id', isset($args['business_id']) && $args['business_id'] ? $args['business_id'] : $with_business->id)
            ->where('user_id', isset($args['business_id']) && $args['business_id'] ? $with_user->id : $this->auth->id)
            ->orderBy('id', 'desc')
            ->first();

        if (isset($args['previous_interview_request_id']) && $args['previous_interview_request_id']) {
            if ($last_interview_request && $last_interview_request->id != $args['previous_interview_request_id']) {
                throw new \Exception('The previous_interview_request is already changed');
            }
        }

        if (!(isset($args['business_id']) && $args['business_id']) && !$last_interview_request) {
            throw new \Exception('The last_interview_request is not found');
        }

        $interview_request = new \App\InterviewRequest;

        if ($last_interview_request) {
            $interview_request->type = $last_interview_request->type;
            $interview_request->phone_number = $last_interview_request->phone_number;
            $interview_request->address = $last_interview_request->address;
            $interview_request->messenger_identifier = $last_interview_request->messenger_identifier;
            $interview_request->interviewer_name = $last_interview_request->interviewer_name;
            $interview_request->date = $last_interview_request->date;
        }

        // [+] validation

        if (isset($args['business_id']) && $args['business_id']) {
            if (isset($args['type']) && $args['type']) {
                if (!in_array($args['type'], ['in_person', 'via_phone', 'via_skype_voice', 'via_skype_video', 'via_im'])) {
                    throw new \Exception('Wrong type argument');
                }

                $interview_request->type = $args['type'];
            }

            if (isset($args['phone_number']) && $args['phone_number']) {
                $interview_request->phone_number = $args['phone_number'];
            }

            if (isset($args['address']) && $args['address']) {
                $interview_request->address = $args['address'];
            }

            if (isset($args['messenger_identifier']) && $args['messenger_identifier']) {
                $interview_request->messenger_identifier = $args['messenger_identifier'];
            }

            if (!$interview_request && (!isset($args['interviewer_name']) || !$args['interviewer_name'])) {
                throw new \Exception('Argument `type` is required');
            }

            if (isset($args['interviewer_name']) && $args['interviewer_name']) {
                $interview_request->interviewer_name = $args['interviewer_name'];
            }

            if (isset($args['date']) && $args['date']) {
                try {
                    $interview_request->date = \DateTime::createFromFormat('m/d/Y h:i A', $args['date']);
                }
                catch (\Exception $exception) {
                    throw new \Exception('Wrond date/time argument');
                }
            }

            if (isset($args['state']) && $args['state']) {
                if (!in_array($args['state'], ['withdrawn'])) {
                    throw new \Exception('Wrong state argument');
                }

                $interview_request->state = $args['state'];
            }
        }
        else {
            if (isset($args['date']) && $args['date']) {
                try {
                    $interview_request->date = \DateTime::createFromFormat('m/d/Y h:i A', $args['date']);
                }
                catch (\Exception $exception) {
                    throw new \Exception('Wrond date/time argument');
                }
            }
        }

        $interview_request->sender_type = isset($args['business_id']) && $args['business_id'] ? 'Business' : 'User';
        $interview_request->state = 'sent';
        $interview_request->user_id = isset($args['business_id']) && $args['business_id'] ? $with_user->id : $this->auth->id;
        $interview_request->business_id = isset($args['business_id']) && $args['business_id'] ? $args['business_id'] : $with_business->id;
        $interview_request->manager_user_id = $this->auth->getKey();

        DB::transaction(function() use ($interview_request, $last_interview_request) {
            if ($last_interview_request && $last_interview_request->state == 'sent') {
                $last_interview_request->state = 'changed';
                $last_interview_request->save();
            }

            $interview_request->save();
        });

        realtime([
            ['type' => 'User', 'id' => $interview_request->user_id],
            ['type' => 'Business', 'id' => $interview_request->business_id],
        ])->emit('interview_requests.count_updated');

        $chat_query = Chat::select('chats.*');
        $chat_query->join('chat_members AS CM0', 'chats.id', '=', 'CM0.chat_id');
        $chat_query->join('chat_members AS CM1', 'chats.id', '=', 'CM1.chat_id');
        $chat_query->where('CM0.business_id', isset($args['business_id']) && $args['business_id'] ? $args['business_id'] : $with_business->id);
        $chat_query->where('CM1.user_id', isset($args['business_id']) && $args['business_id'] ? $with_user->id : $this->auth->id);
        $chat_interlocutor = null;

        if ($chat = $chat_query->first()) {
            $chat->load('members');

            $chat_interlocutor = $chat->interlocutors()
                ->where('user_id', $this->auth->id)
                ->where('business_id', (isset($args['business_id']) && $args['business_id']) ? $args['business_id'] : 0)
                ->first();
        }
        else {
            $chat = new \App\Chat;

            DB::transaction(function() use ($args, $chat, $with_business, $with_user) {
                $chat->save();

                $chat_member0 = new \App\ChatMember;
                $chat_member0->chat_id = $chat->id;
                $chat_member0->business_id = isset($args['business_id']) && $args['business_id'] ? $args['business_id'] : 0;
                $chat_member0->user_id = isset($args['business_id']) && $args['business_id'] ? 0 : $this->auth->id;
                $chat_member0->save();

                $chat_member1 = new \App\ChatMember;
                $chat_member1->chat_id = $chat->id;
                $chat_member1->business_id = isset($args['business_id']) && $args['business_id'] ? 0 : $with_business->id;
                $chat_member1->user_id = isset($args['business_id']) && $args['business_id'] ? $with_user->id : 0;
                $chat_member1->save();

                $chat->setRelation('members', collect([
                    $chat_member0,
                    $chat_member1,
                ]));
            });
        }

        if (!$chat_interlocutor) {
            $chat_interlocutor = new \App\ChatInterlocutor;
            $chat_interlocutor->chat_id = $chat->id;
            $chat_interlocutor->user_id = $this->auth->id;
            $chat_interlocutor->business_id = isset($args['business_id']) && $args['business_id'] ? $args['business_id'] : 0;
            $chat_interlocutor->last_read_message_id = 0;
            $chat_interlocutor->save();
        }

        if (isset($args['business_id']) && $args['business_id']) {
            $chat_member = $chat->members->where('business_id', $args['business_id'])->first();
        }
        else {
            $chat_member = $chat->members->where('user_id', $this->auth->id)->first();
        }

        $chat_member->load('user', 'business');
        $chat_interlocutor->load('user', 'business');
        $chat_message = new \App\ChatMessage;
        $chat_message->chat_id = $chat->id;
        $chat_message->text = '';
        $chat_message->interlocutor_id = $chat_interlocutor->id;
        $chat_message->setRelation('interlocutor', $chat_interlocutor);
        $chat_message->member_id = $chat_member->id;
        $chat_message->setRelation('member', $chat_member);
        $chat_message->interview_request_id = $interview_request->id;
        $chat_message->setRelation('interview_request', $interview_request);

        DB::transaction(function() use ($args, $chat, $chat_message, $chat_interlocutor) {
            $chat_message->save();
            $chat->last_message_id = $chat_message->id;
            $chat->save();
            $chat_interlocutor->last_read_message_id = $chat_message->id;
            $chat_interlocutor->save();
        });

        $interview_request->setRelation('chat_message', $chat_message);

        if ($last_interview_request) {
            $last_interview_request_chat_message = $chat->messages()->where('interview_request_id', $last_interview_request->id)->first();

            if ($last_interview_request_chat_message) {
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
                    'chat_message_id' => $last_interview_request_chat_message->id,
                ]);
            }
        }

        if ($last_interview_request && $last_interview_request->state == 'changed') {
            if (isset($args['business_id']) && $args['business_id']) {
                // Sending chaning interview email
                // $with_user->email
                Mail::to($with_user->email)->queue(new \App\Mail\UserInterview($interview_request, $with_user, $business, 'CHANGE', $this->auth->language_prefix));
            }
            else {
                Mail::to($business->admin->email)->queue(new \App\Mail\BusinessInterview(
                    $interview_request,
                    $with_user,
                    $business,
                    $business->admin,
                    'CHANGE',
                    $this->auth->language_prefix
                ));
            }
        }
        else {
            if (isset($args['business_id']) && $args['business_id']) {
                // Sending new interview email
                Mail::to($with_user->email)->queue(new \App\Mail\UserInterview($interview_request, $with_user, $business, 'REQUEST', $this->auth->language_prefix));
            }
            else {
                // that is usually inpossible case
            }
        }

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
        })->toArray())->emit('chats.message_was_created', [
            'chat_id' => $chat->id,
            'chat_message_id' => $chat_message->id,
            'interlocutor_id' => $chat_interlocutor->id,
        ]);

        // if () {

        //     if (!$interview_request && (!isset($args['type']) || !$args['type'])) {
        //         throw new \Exception('Argument `type` is required');
        //     }

        //     if (isset($args['type']) && $args['type']) {
        //         if (!in_array($args['type'], ['in_person', 'via_phone', 'via_skype_voice', 'via_skype_video', 'via_im'])) {
        //             throw new \Exception('Wrong type argument');
        //         }

        //         $interview_request->type = $args['type'];
        //     }

        //     if (isset($args['phone_number']) && $args['phone_number']) {
        //         $interview_request->phone_number = $args['phone_number'];
        //     }

        //     if (isset($args['address']) && $args['address']) {
        //         $interview_request->address = $args['address'];
        //     }

        //     if (isset($args['messenger_identifier']) && $args['messenger_identifier']) {
        //         $interview_request->messenger_identifier = $args['messenger_identifier'];
        //     }

        //     if (!$interview_request && (!isset($args['interviewer_name']) || !$args['interviewer_name'])) {
        //         throw new \Exception('Argument `type` is required');
        //     }

        //     if (isset($args['interviewer_name']) && $args['interviewer_name']) {
        //         $interview_request->interviewer_name = $args['interviewer_name'];
        //     }

        //     if (isset($args['date']) && $args['date']) {
        //         $interview_request->date->setTimestamp($args['date']);
        //     }

        //     if (isset($args['state']) && $args['state']) {
        //         if (!in_array($args['state'], ['withdrawn'])) {
        //             throw new \Exception('Wrong state argument');
        //         }

        //         $interview_request->state = $args['state'];
        //     }

        //     $interview_request->user_id = $with_user->id;
        //     $interview_request->business_id = $args['business_id'];
        //     $interview_request->save();
        //     $last_interview_request->state = 'changed';
        //     $last_interview_request->save();
        //     $chat_query->where('CM0.business_id', $args['business_id']);
        //     $chat_query->where('CM1.user_id', $with_user->id);
        // }
        // else {
        //     $last_interview_request = \App\InterviewRequest::query()
        //         ->where('business_id', $with_business->id)
        //         ->where('user_id', $this->auth->id)
        //         ->where('state', 'sent')
        //         ->orderBy('id', 'desc')
        //         ->first();

        //     if (!$last_interview_request) {
        //         throw new \Exception('The last_interview_request is not found');
        //     }

        //     $interview_request->type = $last_interview_request->type;
        //     $interview_request->phone_number = $last_interview_request->phone_number;
        //     $interview_request->address = $last_interview_request->address;
        //     $interview_request->messenger_identifier = $last_interview_request->messenger_identifier;
        //     $interview_request->interviewer_name = $last_interview_request->interviewer_name;
        //     $interview_request->date = $last_interview_request->date;

        //     if (isset($args['date']) && $args['date']) {
        //         $interview_request->date->setTimestamp($args['date']);
        //     }

        //     $interview_request->user_id = $this->auth->id;
        //     $interview_request->business_id = $with_business->id;

        //     DB::transaction(function() {
        //         $interview_request->save();
        //         $last_interview_request->state = 'changed';
        //         $last_interview_request->save();
        //     });

        //     $chat_query->where('CM0.business_id', $with_business->id);
        //     $chat_query->where('CM1.user_id', $this->auth->id);

        //     if (!$chat = $chat_query->first()) {
        //         $chat = new \App\Chat;

        //         DB::transaction(function() use ($chat, $with_business) {
        //             $chat->save();

        //             $chat_member0 = new \App\ChatMember;
        //             $chat_member0->chat_id = $chat->id;
        //             $chat_member0->business_id = $with_business->id;
        //             $chat_member0->user_id = 0;
        //             $chat_member0->save();

        //             $chat_member1 = new \App\ChatMember;
        //             $chat_member1->chat_id = $chat->id;
        //             $chat_member1->business_id = 0;
        //             $chat_member1->user_id = $this->auth->id;
        //             $chat_member1->save();
        //         });

        //         $chat_interlocutor = new \App\ChatInterlocutor;
        //         $chat_interlocutor->chat_id = $chat->id;
        //         $chat_interlocutor->user_id = $this->auth->id;
        //         $chat_interlocutor->business_id = 0;
        //         $chat_interlocutor->last_read_message_id = 0;
        //         $chat_interlocutor->save();
        //     }

        //     if (!$chat_member = $chat->members()->where('user_id', $this->auth->id)->first()) {
        //         throw new \Exception('Can\'t find chat member for the user in this chat.');
        //     }

        //     $chat_interlocutor = $chat->interlocutors()
        //         ->where('user_id', $this->auth->id)
        //         ->where('business_id', 0)
        //         ->first();

        //     if (!$chat_interlocutor) {
        //         $chat_interlocutor = new \App\ChatInterlocutor;
        //         $chat_interlocutor->chat_id = $chat->id;
        //         $chat_interlocutor->user_id = $this->auth->id;
        //         $chat_interlocutor->business_id = (isset($args['business_id']) && $args['business_id']) ? $args['business_id'] : 0;
        //         $chat_interlocutor->last_read_message_id = 0;
        //         $chat_interlocutor->save();
        //     }

        //     $chat_member->load('user', 'business');
        //     $chat_interlocutor->load('user', 'business');
        //     $chat_message = new \App\ChatMessage;
        //     $chat_message->chat_id = $chat->id;
        //     $chat_message->text = $args['text'];
        //     $chat_message->interlocutor_id = $chat_interlocutor->id;
        //     $chat_message->setRelation('interlocutor', $chat_interlocutor);
        //     $chat_message->member_id = $chat_member->id;
        //     $chat_message->setRelation('member', $chat_member);

        //     DB::transaction(function() use ($args, $chat, $chat_message, $chat_interlocutor) {
        //         $chat_message->save();
        //         $chat->last_message_id = $chat_message->id;
        //         $chat->save();
        //         $chat_interlocutor->last_read_message_id = $chat_message->id;
        //         $chat_interlocutor->save();
        //     });
        // }

        $interview_request->token = $this->token;
        return $interview_request;
    }
}
