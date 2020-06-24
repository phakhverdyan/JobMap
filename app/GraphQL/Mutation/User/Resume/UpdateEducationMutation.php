<?php

namespace App\GraphQL\Mutation\User\Resume;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Preference;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateEducationMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'UpdateUserPreference not_education'
    ];
    
    public function type()
    {
        return GraphQL::type('EducationNotDisplay');
    }
    
    protected function rules()
    {
        return [
            'not_education' => ['required', 'int'],
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'not_education' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'not education'
            ],
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return null
     */
    public function resolve($root, $args)
    {
        $preference = Preference::where('user_id', $this->auth->id)->update([ 'not_education' => $args['not_education'] ]);

        $data['not_education'] = $args['not_education'];
        $data['token'] = $this->token;

        $user = User::find($this->auth->id);
        $user->updated_at = time();
        $user->save();
    
        return $data;
    }
}
