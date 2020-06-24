<?php

namespace App\GraphQL\Mutation\User\Resume;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Preference;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateExperienceMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'UpdateUserPreference first_job'
    ];
    
    public function type()
    {
        return GraphQL::type('ExperienceFirstJob');
    }
    
    protected function rules()
    {
        return [
            'first_job' => ['required', 'int'],
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'first_job' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'first job'
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
        $preference = Preference::where('user_id', $this->auth->id)->update([ 'first_job' => $args['first_job'] ]);

        $data['first_job'] = $args['first_job'];
        $data['token'] = $this->token;

        $user = User::find($this->auth->id);
        $user->updated_at = time();
        $user->save();
    
        return $data;
    }
}
