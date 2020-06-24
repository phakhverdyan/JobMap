<?php

namespace App\GraphQL\Mutation\User\Resume;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\UserSelection;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DelPrintBuilderSelectionMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'Del PrintBuilder Selection'
    ];
    
    public function type()
    {
        return GraphQL::type('DelPrintBuilderSelection');
    }
    
    protected function rules()
    {
        return [
            'id' => ['required']
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'selections string'
            ]
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return null
     */
    public function resolve($root, $args)
    {
        $data = [];
        $data['result'] = 'error';
        if (UserSelection::find($args['id'])->delete()) {
            $data['result'] = 'success';
        }

        $data['token'] = $this->token;
        return $data;
    }
}
