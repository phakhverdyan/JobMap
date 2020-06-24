<?php

namespace App\GraphQL\Query\User\Auth;

use App\User\Resume\UserSelection;
use GraphQL;
use GraphQL\Type\Definition\Type;
use App\GraphQL\Extensions\AuthQuery;

class LoadPrintBuilderSelectionQuery extends AuthQuery
{
    protected $attributes = [
        'name' => 'LoadPrintBuilderSelection'
    ];
    
    public function type()
    {
        return GraphQL::type('LoadPrintBuilderSelection');
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
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args)
    {
        $data['selection'] = UserSelection::find($args['id']);
        
        $data['token'] = $this->token;
        
        return $data;
    }
}
