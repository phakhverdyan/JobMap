<?php

namespace App\GraphQL\Mutation\User\Resume;

use App\GraphQL\Auth;
use App\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class SavePrintBuilderSelectionMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'Save PrintBuilder Selection'
    ];
    
    public function type()
    {
        return GraphQL::type('SavePrintBuilderSelection');
    }
    
    protected function rules()
    {
        return [
            'selections' => ['required','string','min:1'],
            'title' =>  ['required','string','min:3'],
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'selections' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'selections string'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'save name'
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
        $data = User::find($this->auth->id);
        parse_str($args['selections'],$sss);
        $selections = json_encode($sss);
        $data['selection'] = $data->selections()->create([
            'selections' => $selections,
            'title' => $args['title']
        ]);

        $data['token'] = $this->token;
        return $data;
    }
}
