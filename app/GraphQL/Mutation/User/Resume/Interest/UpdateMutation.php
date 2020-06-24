<?php

namespace App\GraphQL\Mutation\User\Resume\Interest;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Interest;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\App;

class UpdateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'Update User Interest'
    ];
    
    public function type()
    {
        return GraphQL::type('UserInterest');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'id' => ['required', 'string'],
            'title' => ['required', 'string'],
            //'description' => ['required', 'string']
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
                'description' => 'Interest ID'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'Interest title'
            ],
            'title_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Job title_id'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Interest title'
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
        $update = [];
        $fieldsFirstLetter = [
            'title',
            'description',
        ];

        if (!is_numeric($args['title_id'])) {
            $idNew = 0;
            if (App::isLocale('fr')) {
                if ($item = User\Resume\Autocomplete\Interest::where('title_fr',$args['title_id'])->first()) {
                    $idNew = $item->id;
                }
            } else {
                if ($item = User\Resume\Autocomplete\Interest::where('title',$args['title_id'])->first()) {
                    $idNew = $item->id;
                }
            }
            if ($idNew ==0) {
                $item = User\Resume\Autocomplete\Interest::create([
                    'title' => $args['title_id'],
                    'title_fr' => $args['title_id']
                ]);
                $idNew = $item->id;
            }
            $args['title_id'] = $idNew;
        }

        foreach ($args as $field => $value) {
            if($field != 'id') {
                if (in_array($field,$fieldsFirstLetter)) {
                    $update[$field] = ucfirst($value);
                } else {
                    $update[$field] = $value;
                }
            }
        }
    
        $interest = Interest::where([
            'user_id' => $this->auth->id,
            'id' => $args['id']
        ])->update($update);
        
        if (!$interest) {
            return null;
        }
    
        $query = Interest::query();
        $query->where([
            'user_id' => $this->auth->id,
            'id' => $args['id']
        ]);
    
        $data = $query->first();
        $data['token'] = $this->token;

        $user = User::find($this->auth->id);
        $user->updated_at = $data['updated_at'];
        $user->save();
    
        return $data;
    }
}
