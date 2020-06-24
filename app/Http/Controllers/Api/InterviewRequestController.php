<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Http\Resources\BaseCollectionResource;
use App\Business\Administrator;
use App\Chat;
use App\WorldLanguage;
use App\InterviewRequest;

class InterviewRequestController extends Controller
{
	public function create(Request $request)
	{
		$business = null;

        if ($request->input('business_id')) {
            $business = \App\Business::where('id', $request->input('business_id'))->first();
        }

        $with_business = null;
        $with_user = null;

        if ($request->input('business_id')) {
            if (!$request->input('with_user_id')) {
                throw new \Exception('Argument `with_user_id` not set');
            }

            if (!$with_user = \App\User::where('id', $request->input('with_user_id'))->first()) {
                throw new \Exception('The user `with_user_id` is not found');
            }
        }
        else {
            if (!$request->input('with_business_id')) {
                throw new \Exception('Argument `with_business_id` not set');
            }

            if (!$with_business = \App\Business::where('id', $request->input('with_business_id'))->first()) {
                throw new \Exception('The business `with_business_id` is not found');
            }
        }

        $last_interview_request = \App\InterviewRequest::query()
            ->where('business_id', $request->input('business_id') ? $request->input('business_id') : $with_business->id)
            ->where('user_id', $request->input('business_id') ? $with_user->id : auth()->user()->id)
            ->orderBy('id', 'desc')
            ->first();

        if ($request->input('previous_interview_request_id')) {
            if ($last_interview_request && $last_interview_request->id != $request->input('previous_interview_request_id')) {
                throw new \Exception('The previous_interview_request is already changed');
            }
        }

        if (!$request->input('business_id') && !$last_interview_request) {
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

        if ($request->input('business_id')) {
            if ($request->input('type')) {
                if (!in_array($request->input('type'), ['in_person', 'via_phone', 'via_skype_voice', 'via_skype_video', 'via_im'])) {
                    throw new \Exception('Wrong type argument');
                }

                $interview_request->type = $request->input('type');
            }

            if ($request->input('phone_number')) {
                $interview_request->phone_number = $request->input('phone_number');
            }

            if ($request->input('address')) {
                $interview_request->address = $request->input('address');
            }

            if ($request->input('messenger_identifier')) {
                $interview_request->messenger_identifier = $request->input('messenger_identifier');
            }

            if (!$interview_request && !$request->input('interviewer_name')) {
                throw new \Exception('Argument `interviewer_name` is required');
            }

            if ($request->input('interviewer_name')) {
                $interview_request->interviewer_name = $request->input('interviewer_name');
            }

            if ($request->input('date')) {
                try {
                    $interview_request->date = \DateTime::createFromFormat('m/d/Y h:i A', $request->input('date'));
                } catch (\Exception $exception) {
                    throw new \Exception('Wrond date/time argument');
                }
            }

            if ($request->input('state')) {
                if (!in_array($request->input('state'), ['withdrawn'])) {
                    throw new \Exception('Wrong state argument');
                }

                $interview_request->state = $request->input('state');
            }
        } else {
            if ($request->input('date')) {
                try {
                    $interview_request->date = \DateTime::createFromFormat('m/d/Y h:i A', $request->input('date'));
                } catch (\Exception $exception) {
                    throw new \Exception('Wrond date/time argument');
                }
            }
        }

        $interview_request->sender_type = $request->input('business_id') ? 'Business' : 'User';
        $interview_request->state = 'sent';
        $interview_request->user_id = $request->input('business_id') ? $with_user->id : auth()->user()->id;
        $interview_request->business_id = $request->input('business_id') ? $request->input('business_id') : $with_business->id;
        $interview_request->manager_user_id = auth()->user()->getKey();

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
        $chat_query->where('CM0.business_id', $request->input('business_id') ? $request->input('business_id') : $with_business->id);
        $chat_query->where('CM1.user_id', $request->input('business_id') ? $with_user->id : auth()->user()->id);
        $chat_interlocutor = null;

        if ($chat = $chat_query->first()) {
            $chat->load('members');

            $chat_interlocutor = $chat->interlocutors()
                ->where('user_id', auth()->user()->id)
                ->where('business_id', $request->input('business_id') ? $request->input('business_id') : 0)
                ->first();
        } else {
            $chat = new \App\Chat;

            DB::transaction(function() use ($request, $chat, $with_business, $with_user) {
                $chat->save();

                $chat_member0 = new \App\ChatMember;
                $chat_member0->chat_id = $chat->id;
                $chat_member0->business_id = $request->input('business_id') ? $request->input('business_id') : 0;
                $chat_member0->user_id = $request->input('business_id') ? 0 : auth()->user()->id;
                $chat_member0->save();

                $chat_member1 = new \App\ChatMember;
                $chat_member1->chat_id = $chat->id;
                $chat_member1->business_id = $request->input('business_id') ? 0 : $with_business->id;
                $chat_member1->user_id = $request->input('business_id') ? $with_user->id : 0;
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
            $chat_interlocutor->user_id = auth()->user()->id;
            $chat_interlocutor->business_id = $request->input('business_id') ? $request->input('business_id') : 0;
            $chat_interlocutor->last_read_message_id = 0;
            $chat_interlocutor->save();
        }

        if ($request->input('business_id')) {
            $chat_member = $chat->members->where('business_id', $request->input('business_id'))->first();
        }
        else {
            $chat_member = $chat->members->where('user_id', auth()->user()->id)->first();
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

        DB::transaction(function() use ($chat, $chat_message, $chat_interlocutor) {
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
            if ($request->input('business_id')) {
                // Sending chaning interview email
                // $with_user->email
                Mail::to($with_user->email)->queue(new \App\Mail\UserInterview($interview_request, $with_user, $business, 'CHANGE', auth()->user()->language_prefix));
            } else {
                if ($business) Mail::to($business->admin->email)->queue(new \App\Mail\BusinessInterview(
                    $interview_request,
                    $with_user,
                    $business,
                    $business->admin,
                    'CHANGE',
                    auth()->user()->language_prefix
                ));
            }
        } else {
            if ($request->input('business_id')) {
                // Sending new interview email
                Mail::to($with_user->email)->queue(new \App\Mail\UserInterview($interview_request, $with_user, $business, 'REQUEST', auth()->user()->language_prefix));
            } else {
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

        return new BaseResource($interview_request);
	}

    public function get(Request $request, $interview_request_id)
    {
        $interview_request = InterviewRequest::findOrFail($interview_request_id);

        $interview_request->load([
            'business',
            'user',
        ]);

        return response()->resource($interview_request);
    }

    public function update(Request $request, $interview_request_id)
    {
    	$interview_request = InterviewRequest::where('id', $interview_request_id)->firstOrFail();

    	validator()->make($request->all(), [
    		'business_id' => 'integer|nullable',
    		'interview_request' => 'required|array',
    		'interview_request.internal_description' => 'string|nullable',
    		'interview_request.external_description' => 'string|nullable',
    		'interview_request.state' => 'required|string|in:finished,accepted,rejected,withdrawn',
    	])->validate();

        if ($request->input('business_id')) {
            if ($interview_request->business_id != $request->input('business_id')) {
                throw new \Exception('The interview request is not found');
            }
        } else {
            if ($interview_request->user_id != auth()->user()->id) {
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

        if (!$request->input('interview_request.state')) {
            throw new \Exception('The `state` argument is not set');
        }

        if ($request->input('business_id')) {
            if ($interview_request->sender_type == 'Business') {
                if (!in_array($request->input('interview_request.state'), ['withdrawn', 'finished'])) {
                    throw new \Exception('Wrong interview request state');
                }
            } else {
                if (!in_array($request->input('interview_request.state'), ['accepted', 'rejected', 'finished'])) {
                    throw new \Exception('Wrong interview request state');
                }
            }
        } else {
            if ($interview_request->sender_type == 'User') {
                if (!in_array($request->input('interview_request.state'), ['withdrawn'])) {
                    throw new \Exception('Wrong interview request state');
                }
            } else {
                if (!in_array($request->input('interview_request.state'), ['accepted', 'rejected'])) {
                    throw new \Exception('Wrong interview request state');
                }
            }
        }

        if ($request->input('interview_request.internal_description')) {
            $interview_request->internal_description = trim($request->input('interview_request.internal_description'));
        }

        if ($request->input('interview_request.external_description')) {
            $interview_request->external_description = trim($request->input('interview_request.external_description'));
        }

        $interview_request->state = $request->input('interview_request.state');
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

        if (!$request->input('business_id') && $request->input('interview_request.state') == 'accepted') {
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

        if (!$request->input('business_id')) {
            if ($interview_request->sender_type == 'Business') {
                if ($interview_request->state == 'accepted') {
                    if ($with_user = \App\User::where('id', $interview_request->user_id)->first()) {
                        Mail::to($with_user->email)->queue(new \App\Mail\UserInterview(
                            $interview_request,
                            $interview_request->user,
                            $interview_request->business,
                            'ACCEPTED',
                            auth()->user()->language_prefix
                        ));

                        Mail::to($interview_request->business->admin->user->email)->queue(new \App\Mail\BusinessInterview(
                            $interview_request,
                            $interview_request->user,
                            $interview_request->business,
                            $interview_request->business->admin->user,
                            'ACCEPTED',
                            auth()->user()->language_prefix
                        ));
                    }
                }
            }
        }

        return new BaseResource($interview_request);
    }
}
