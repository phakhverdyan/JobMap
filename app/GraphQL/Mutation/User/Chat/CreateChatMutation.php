<?php

namespace App\GraphQL\Mutation\User\Chat;

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

class CreateChatMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Create new chat'
    ];

    public function type()
    {
        return GraphQL::type('Chat');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'business_id' => ['required', 'numeric'],
        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
            ],
            'with_user_id' => [
                'type' => Type::id(),
            ],
            'with_business_id' => [
                'type' => Type::id(),
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args)
    {
        $authManagerRole = null;

        if (isset($args['business_id']) && $args['business_id']) {
            $authManagerRole = get_manager_role($args['business_id']);

            $this->checkBusinessAccess($args['business_id'], [
                \App\Business\Administrator::MANAGER_ROLE,
                \App\Business\Administrator::BRANCH_ROLE,
            ], ['chats']);
        }

        if (isset($args['business_id']) && $args['business_id']) {
            if (!\App\User::where('id', $args['with_user_id'])->first()) {
                throw new \Exception('The interlocutor user is not found');
            }
        }
        else {
            if (!\App\Business::where('id', $args['with_business_id'])->first()) {
                throw new \Exception('The interlocutor business is not found');
            }
        }

        $chat_query = Chat::select('chats.*');
        $chat_query->join('chat_members AS CM0', 'chats.id', '=', 'CM0.chat_id');
        $chat_query->join('chat_members AS CM1', 'chats.id', '=', 'CM1.chat_id');
        $chat_query->where('CM0.business_id', isset($args['business_id']) && $args['business_id'] ? $args['business_id'] : $args['with_business_id']);
        $chat_query->where('CM0.manager_id', isset($args['business_id']) && $args['business_id'] ? $this->auth->id : null);
        $chat_query->where('CM1.user_id', isset($args['business_id']) && $args['business_id'] ? $args['with_user_id'] : $this->auth->id);

        if ($chat = $chat_query->first()) {
            throw new \Exception('The chat already exists');
        }

        $chat = new \App\Chat;

        DB::transaction(function() use ($args, $chat) {
            $chat->save();

            $member0 = new \App\ChatMember;
            $member0->chat_id = $chat->id;
            $member0->business_id = isset($args['business_id']) && $args['business_id'] ? $args['business_id'] : 0;
            $member0->manager_id = isset($args['business_id']) && $args['business_id'] ? $this->auth->id : null;
            $member0->user_id = isset($args['business_id']) && $args['business_id'] ? 0 : $this->auth->id;
            $member0->save();

            $member1 = new \App\ChatMember;
            $member1->chat_id = $chat->id;
            $member1->business_id = isset($args['business_id']) && $args['business_id'] ? 0 : $args['with_business_id'];
            $member1->user_id = isset($args['business_id']) && $args['business_id'] ? $args['with_user_id'] : 0;
            $member1->save();
        });

        $chat->token = $this->token;
        return $chat;
    }
}
