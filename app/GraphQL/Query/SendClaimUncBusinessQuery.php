<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Traits\ShouldValidate;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Business\BusinessUnconfirmed;
use App\Mail\SendClaimUncBusiness;
use Illuminate\Support\Facades\Mail;

class SendClaimUncBusinessQuery extends Query
{
    use ShouldValidate;

    protected $attributes = [
        'name' => 'sendClaimUBis'
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
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', 'max:100'],
            'phone' => ['required', 'string', 'min:4', 'max:30'],
            'employer_number' => ['required', 'integer'],
            'time' => ['required', 'string', 'min:1', 'max:200'],
            'message' => ['required', 'string', 'min:4'],
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'first_name' => [
                'name' => 'first_name',
                'type' => Type::string(),
            ],
            'last_name' => [
                'name' => 'last_name',
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
            'employer_number' => [
                'type' => Type::string(),
            ],
            'time' => [
                'type' => Type::string(),
            ],
            'message' => [
                'name' => 'message',
                'type' => Type::string(),
            ],
            'id' => [
                'type' => Type::nonNull(Type::id()),
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
            'response' => 'success',
            'message' => 'We will get back to you as soon as possible.',
        ];

        $mailTo = 'info.bmvo@gmail.com';

        $args['business'] = BusinessUnconfirmed::select('id', 'name')->whereId($args['id'])->first();
        Mail::to($mailTo)->queue(new SendClaimUncBusiness($args, $this->auth->language_prefix));

        return $result;
    }
}
