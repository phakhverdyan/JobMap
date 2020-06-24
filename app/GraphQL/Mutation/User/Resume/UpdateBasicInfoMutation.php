<?php

namespace App\GraphQL\Mutation\User\Resume;

use App\GraphQL\Auth;
use App\Rules\CheckValidGeo;
use App\User;
use App\User\Resume\BasicInfo;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateBasicInfoMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'UpdateUserBasicInfo'
    ];
    
    public function type()
    {
        return GraphQL::type('UserBasicInfo');
    }
    
    protected function rules()
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            //'headline' => ['required_without:headline_fr', 'string'],
            //'headline_fr' => ['required_without:headline', 'string'],
            //'street' => ['required', 'string', new CheckValidGeo()],
            //'city' => ['required', 'string', new CheckValidGeo()],
            'phone_number' => ['required', 'string'],
            //'about' => ['required_without:about_fr', 'string'],
            //'about_fr' => ['required_without:about', 'string'],
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'headline' => [
                'type' => Type::string(),
                'description' => 'Resume Headline'
            ],
            'headline_fr' => [
                'type' => Type::string(),
                'description' => 'Resume Headline FR'
            ],
            'first_name' => [
                'type' => Type::string(),
                'description' => 'User first name'
            ],
            'last_name' => [
                'type' => Type::string(),
                'description' => 'User last name'
            ],
            'birth_date' => [
                'name' => 'birth_date',
                'type' => Type::string(),
            ],
            'street' => [
                'type' => Type::string(),
                'description' => 'User Street'
            ],
            'city' => [
                'type' => Type::string(),
                'description' => 'User City'
            ],
            'region' => [
                'type' => Type::string(),
                'description' => 'User Region'
            ],
            'country' => [
                'type' => Type::string(),
                'description' => 'User Country'
            ],
            'country_code' => [
                'type' => Type::string(),
                'description' => 'User Country Code'
            ],
            'phone_number' => [
                'type' => Type::string(),
                'description' => 'Resume Mobile Phone'
            ],
            'phone_code' => [
                'name' => 'phone_code',
                'type' => Type::string(),
            ],
            'phone_country_code' => [
                'name' => 'phone_country_code',
                'type' => Type::string(),
            ],
            'website' => [
                'type' => Type::string(),
                'description' => 'Resume Website'
            ],
            'about' => [
                'type' => Type::string(),
                'description' => 'Resume About User'
            ],
            'about_fr' => [
                'type' => Type::string(),
                'description' => 'Resume About User FR'
            ],
            'facebook' => [
                'type' => Type::string(),
                'description' => 'facebook'
            ],
            'instagram' => [
                'type' => Type::string(),
                'description' => 'instagram'
            ],
            'linkedin' => [
                'type' => Type::string(),
                'description' => 'linkedin'
            ],
            'twitter' => [
                'type' => Type::string(),
                'description' => 'twitter'
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
        $update = [];

        $fieldsFirstLetter = [
            'headline',
            'headline_fr',
            'about',
            'about_fr',
            'first_name',
            'last_name',
            'street',
            'city',
        ];

        foreach ($args as $field => $value) {
            if (in_array($field,$fieldsFirstLetter)) {
                $value = ucfirst($value);
            }

            if ($value != "" && $field != "street" && $field != "city" && $field != "region" && $field != "country" && $field != "country_code"
                && $field != "phone_number" && $field != "phone_code" && $field != "phone_country_code"
                && $field != "birth_date" && $field != "first_name" && $field != "last_name") {
                $update[$field] = $value;
            }
        }

        $update['is_complete'] = 1;
        
        $basicInfo = BasicInfo::where('user_id', $this->auth->id)->update($update);

        if (!$basicInfo) {
            return null;
        }
        
        User::where('id', $this->auth->id)->update([
            'first_name' => $args['first_name'],
            'last_name' => $args['last_name'],
            'birth_date' => $args['birth_date'],
            'street' => $args['street'],
            'city' => $args['city'],
            'region' => $args['region'],
            'country' => $args['country'],
            'country_code' => $args['country_code'],
            'phone_number' => $args['phone_number'],
            'phone_code' => $args['phone_code'],
            'phone_country_code' => $args['phone_country_code']
        ]);
        
        $query = BasicInfo::where('user_id', $this->auth->id);
        
        $data = $query->first();
        $data['token'] = $this->token;

        $user = User::find($this->auth->id);
        $user->recalculateResumeIsCompleted();
        $user->updated_at = $data['updated_at'];
        $user->save();
        
        return $data;
    }
}
