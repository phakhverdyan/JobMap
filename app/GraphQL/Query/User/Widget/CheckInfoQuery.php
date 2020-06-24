<?php

namespace App\GraphQL\Query\User\Widget;

use GraphQL;
use App\GraphQL\AuthToken;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Folklore\GraphQL\Error\ValidationError;

class CheckInfoQuery extends Mutation
{
    use AuthToken;

    protected $attributes = [
        'name' => 'checkInfo'
    ];

    public function type()
    {
        return GraphQL::type('WidgetInfoCheck');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [

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
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args)
    {
        $rules = [
            'first_name' => ['required', 'string'],
            'last_name'  => ['required', 'string'],
            'email'      => ['required', 'email', 'unique:users,email'],
        ];

        //set rules after authorize
        $validator = $this->getValidator($args, $rules);

        if ($validator->fails()) {
            throw with(new ValidationError('validation'))->setValidator($validator);
        }
        
        return [ 'response' => 'ok' ];
    }
}
