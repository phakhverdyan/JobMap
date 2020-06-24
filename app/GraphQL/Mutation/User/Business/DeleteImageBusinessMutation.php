<?php

namespace App\GraphQL\Mutation\User\Business;

use App\Business\Administrator;
use App\Business\Image;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteImageBusinessMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'deleteImageBusiness'
    ];
    
    public function type()
    {
        return GraphQL::type('DeleteImageBusiness');
    }
    
    /**
     * @return array
     */
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
                'description' => 'The id of the business'
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
        $data = [];
        $data['response'] = 'error';
        if ($el = Image::find($args['id'])) {
            $el->delete();
            $data['response'] = 'ok';
        }
        $data['token'] = $this->token;

        return $data;
    }
}
