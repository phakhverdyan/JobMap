<?php

namespace App\GraphQL\Mutation\User;

use App\GraphQL\Auth;
use App\User\Resume\Preference;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class SavePreferenceFieldsUserMutation extends Mutation
{
    use Auth;

    protected $attributes = [
        'name' => 'SavePreferenceFieldsUser'
    ];
    
    public function type()
    {
        return GraphQL::type('SavePreferenceFieldsUser');
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
            'looking_job' => [
                'name' => 'looking_job',
                'type' => Type::string(),
            ],
            'new_job' => [
                'name' => 'new_job',
                'type' => Type::string(),
            ],
            'its_urgent' => [
                'name' => 'its_urgent',
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
        if (count($args) > 0) {
            Preference::where('user_id', $this->auth->id)->update($args);
        }

        return [
            'result' => 'success',
            'token' => $this->token
        ];
    }
}
