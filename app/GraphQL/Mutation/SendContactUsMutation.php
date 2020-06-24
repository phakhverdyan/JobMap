<?php

namespace App\GraphQL\Mutation;

use App\Contact;
use App\Mail\ContactUsSend;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Mail;

class SendContactUsMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Send ContactUs'
    ];
    
    public function type()
    {
        return GraphQL::type('SendContactUs');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'subject' => ['required', 'string', 'min:3', 'max:200'],
            'email' => ['required', 'email', 'max:100'],
            'phone' => ['required', 'string', 'min:4', 'max:30'],
            'full_name' => ['required', 'string', 'min:3', 'max:100'],
            'message' => ['required', 'string', 'min:4'],
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'language' => [
                'name' => 'language',
                'type' => Type::nonNull(Type::string()),
            ],
            'type' => [
                'name' => 'type',
                'type' => Type::nonNull(Type::string()),
            ],
            'subject' => [
                'name' => 'subject',
                'type' => Type::string(),
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
            ],
            'phone' => [
                'name' => 'phone',
                'type' => Type::string(),
            ],
            'full_name' => [
                'name' => 'full_name',
                'type' => Type::string(),
            ],
            'message' => [
                'name' => 'message',
                'type' => Type::string(),
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
        $result = [
            'response' => 'error',
            'message' => 'Error sending a message please try later.',
        ];
        if ($contact = Contact::create($args)) {
            $result = [
                'response' => 'success',
                'message' => 'We will get back to you as soon as possible.',
            ];
        }

        switch ($args['type']) {
            case 'general':
                $mailTo = 'info.bmvo@gmail.com';
                break;
            case 'support':
                $mailTo = 'info.bmvo@gmail.com';
                break;
            case 'sales':
                $mailTo = 'info.bmvo@gmail.com';
                break;
            case 'callback':
                $mailTo = 'info.bmvo@gmail.com';
                break;
            default:
                $mailTo = 'info.bmvo@gmail.com';
                break;
        }

        Mail::to($mailTo)
            ->queue(new ContactUsSend($args, $this->auth->language_prefix));

        return $result;
    }
}
