<?php

namespace App\GraphQL\Mutation\User\Resume;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Preference;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateCertificationMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'UpdateUseCertification not_certification not_distinction'
    ];
    
    public function type()
    {
        return GraphQL::type('CertificationNot');
    }
    
    protected function rules()
    {
        return [
            'not_certification' => ['int'],
            'not_distinction' => ['int'],
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'not_certification' => [
                'type' => Type::int(),
                'description' => 'not certification'
            ],
            'not_distinction' => [
                'type' => Type::int(),
                'description' => 'not distinction'
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
        $data = [];
        $isUpdate = false;
        if (isset($args['not_certification'])) {
            $data['not_certification'] = $args['not_certification'];
            $isUpdate = true;
        }
        if (isset($args['not_distinction'])) {
            $data['not_distinction'] = $args['not_distinction'];
            $isUpdate = true;
        }

        if ($isUpdate) {
            $preference = Preference::where('user_id', $this->auth->id)->update($data);
            $user = User::find($this->auth->id);
            $user->updated_at = time();
            $user->save();
        }

        $data['token'] = $this->token;
    
        return $data;
    }
}
