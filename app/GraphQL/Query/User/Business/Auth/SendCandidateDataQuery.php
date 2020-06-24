<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Mail\SendCandidateData;
use App\User;
use Folklore\GraphQL\Support\Traits\ShouldValidate;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\Mail;

class SendCandidateDataQuery extends Query
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
            'email' => ['required', 'email', 'max:100'],
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'email' => [
                'name' => 'email',
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
            'message' => 'ok',
        ];

        $mailTo = $args['email'];

        $data = User::find($args['id']);
        Mail::to($mailTo)->queue(new SendCandidateData($data, $this->auth->language_prefix));

        return $result;
    }
}
