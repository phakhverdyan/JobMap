<?php

namespace App\GraphQL\Mutation;

use App\Mail\RequestCallbackSend;
use App\RequestCallback;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Mail;

class SendRequestCallbackMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Send RequestCallback'
    ];
    
    public function type()
    {
        return GraphQL::type('SendRequestCallback');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'email' => ['required', 'email'],
            'contact_name' => ['required', 'string', 'min:3', 'max:200'],
            'employer_name' => ['required', 'string', 'min:3', 'max:200'],
            'employer_number' => ['required', 'integer'],
            'location_number' => ['required', 'integer'],
            'phone' => ['required', 'string', 'min:3', 'max:200'],
            'extension' => ['required', 'string', 'min:1', 'max:200'],
            'time' => ['required', 'string', 'min:1', 'max:200'],
            'country' => ['required', 'string', 'min:3', 'max:200'],
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'email' => [
                'type' => Type::string(),
            ],
            'contact_name' => [
                'type' => Type::string(),
            ],
            'employer_name' => [
                'type' => Type::string(),
            ],
            'employer_number' => [
                'type' => Type::string(),
            ],
            'location_number' => [
                'type' => Type::string(),
            ],
            'phone' => [
                'type' => Type::string(),
            ],
            'extension' => [
                'type' => Type::string(),
            ],
            'message' => [
                'type' => Type::string(),
            ],
            'time' => [
                'type' => Type::string(),
            ],
            'country' => [
                'type' => Type::string(),
            ],
            'website' => [
                'type' => Type::string(),
            ],
            'business_name' => [
                'type' => Type::string(),
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
        $result = [
            'response' => 'error',
            'message' => 'Error sending a message please try later.',
        ];
        
        if ($contact = RequestCallback::create($args)) {
            $result = [
                'response' => 'success',
                'message' => 'We will get back to you as soon as possible.',
            ];
        }

        $mailTo = 'info.bmvo@gmail.com';
        Mail::to($mailTo)->queue(new RequestCallbackSend($args, $this->auth->language_prefix));
        return $result;
    }
}
