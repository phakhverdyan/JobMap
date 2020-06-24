<?php

namespace App\GraphQL\Mutation\User;

use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\Mail\FeedbackSend;
use App\Mail\VerificationUser;
use App\User\Feedback;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\User;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class SendFeedbackMutation extends Mutation
{
    use Auth;

    protected $attributes = [
        'name' => 'Send feedback'
    ];

    public function type()
    {
        return GraphQL::type('SendFeedback');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'message' => ['required', 'string', 'min:10']
        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'business_id' => [
                'type' => Type::id(),
            ],

            'message' => [
                'type' => Type::string()
            ]

        ];
    }

    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args)
    {
        if (isset($args['business_id']) && $args['business_id']) {
            $this->checkBusinessAccess($args['business_id'], [
                \App\Business\Administrator::MANAGER_ROLE,
                \App\Business\Administrator::BRANCH_ROLE,
            ]);
        }

        if (isset($args['business_id']) && $args['business_id']) {
            $business = \App\Business::where('id', $args['business_id'])->first();
        }
        else {
            $business = null;
        }

        $feedback = Feedback::create([
            'user_id' => $this->auth->id,
            'business_id' => ($business ? $business->id : 0),
            'message' => $args['message'],
        ]);

        // Mail::to(env('FEEDBACK_EMAIL', 'atom-danil@yandex.ru'))->queue(new FeedbackSend($this->auth, $business, $args['message']));

        if ($business) {
            Mail::to($this->auth->email)->queue(new \App\Mail\BusinessFeedback($business,'INITIAL', $this->auth->language_prefix));
        }
        else {
            Mail::to($this->auth->email)->queue(new \App\Mail\UserFeedback($this->auth, 'INITIAL', $this->auth->language_prefix));
        }

        return [
            'response' => true,
        ];
    }
}
