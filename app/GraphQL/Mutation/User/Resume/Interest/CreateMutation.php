<?php

namespace App\GraphQL\Mutation\User\Resume\Interest;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Interest;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\App;

class CreateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'New User Interest'
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
            'title' => ['required', 'string'],
            //'description' => ['required', 'string'],
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
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

        $interest = new Interest;
        $interest->user_id = $this->auth->id;
        
        foreach ($args as $k => $v){
            if (in_array($v, $fieldsFirstLetter)) {
                $interest->{$k} = ucfirst($v);
            } else {
                $interest->{$k} = $v;
            }
        }
    
        $interest->save();
        $interest->token = $this->token;

        $user = User::find($this->auth->id);
        $user->recalculateResumeIsCompleted();
        $user->updated_at = $interest->updated_at;
        $user->save();
        
        return $interest;
    }
}
