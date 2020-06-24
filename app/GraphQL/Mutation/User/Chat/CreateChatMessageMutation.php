<?php

namespace App\GraphQL\Mutation\User\Chat;

use App\GraphQL\Auth;
use App\GraphQL\AuthToken;
use App\Chat;
use App\ChatMessage;
use App\WorldLanguage;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;
use Folklore\GraphQL\Error\ValidationError;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use App\Business\Administrator;

class CreateChatMessageMutation extends Mutation
{
    //use JWT authorization
    use Auth;

    protected $attributes = [
        'name' => 'newMessage',
    ];

    public function type()
    {
        return GraphQL::type('ChatMessage');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            // 'chat_id' => ['required', 'string'],
            // 'text' => ['required', 'string'],
            // 'chat_interlocutor_type' => ['required', 'string'],
            // 'chat_secret_token' => ['required', 'string'],
        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'business_id' => [
                'type' => Type::int(),
                'description' => 'The ID of the business (optional)',
            ],

            'chat_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Text of the new message',
            ],

            'text' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Text of the new message',
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

        $authManagerRole = false;

        if (!$chat = \App\Chat::where('id', $args['chat_id'])->first()) {
            throw new \Exception('The chat not found.');
        }

        $chat_members = $chat->members()->get();

        if (isset($args['business_id']) && $args['business_id']) {

            $authManagerRole = get_manager_role($args['business_id']);

            if (!$chat_member = $chat_members->where('business_id', $args['business_id'])->first()) {
                throw new \Exception('Permission error.');
            }
        }
        else {
            if (!$chat_member = $chat_members->where('user_id', $this->auth->id)->first()) {
                throw new \Exception('Permission error.');
            }
        }

        if (!isset($args['text']) || !$args['text'] || !trim($args['text'])) {
            throw new \Exception('The `text` argument cannot be empty');

        }

        $chat_interlocutor = $chat->interlocutors()
            ->where('user_id', $this->auth->id)
            ->where('business_id', (isset($args['business_id']) && $args['business_id']) ? $args['business_id'] : 0)
            ->first();

        if (!$chat_interlocutor) {
            $chat_interlocutor = new \App\ChatInterlocutor;
            $chat_interlocutor->chat_id = $chat->id;
            $chat_interlocutor->user_id = $this->auth->id;

            if ($authManagerRole && $authManagerRole === Administrator::FRANCHISE_ROLE) {
                $chat_interlocutor->manager_id = $this->auth->id;
            }

            $chat_interlocutor->business_id = (isset($args['business_id']) && $args['business_id']) ? $args['business_id'] : 0;
            $chat_interlocutor->last_read_message_id = 0;
            $chat_interlocutor->save();
        }

        $chat_member->load('user', 'business');
        $chat_interlocutor->load('user', 'business');
        $chat_message = new \App\ChatMessage;
        $chat_message->chat_id = $chat->id;
        $chat_message->text = trim($args['text']);
        $chat_message->interlocutor_id = $chat_interlocutor->id;

        if ($authManagerRole && $authManagerRole === Administrator::FRANCHISE_ROLE) {
            $chat_message->manager_id = $this->auth->id;
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
                    $this->auth->language_prefix
                ));
            });
        }

        DB::transaction(function() use ($args, $chat, $chat_message, $chat_interlocutor) {
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

        return array_merge($chat_message->toArray(), [
            'token' => $this->token,
        ]);
    }
}
