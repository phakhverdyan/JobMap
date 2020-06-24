<?php

namespace App\GraphQL\Mutation\User;

use App\Business;
use App\Business\Import;
use App\Candidate\Candidate;
use App\GraphQL\AuthToken;
use App\Mail\BusinessNotifications;
use App\Mail\VerificationUser;
use App\User\Resume\Availability;
use App\User\Resume\BasicInfo;
use App\User\Resume\Preference;
use App\UserSocials;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\User;
use Illuminate\Support\Facades\DB;
use Folklore\GraphQL\Error\ValidationError;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class CreateCheckMutation extends Mutation
{
    use AuthToken;

    protected $attributes = [
        'name' => 'newUserCheck'
    ];

    public function type()
    {
        return GraphQL::type('UserCheck');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [

        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'username' => [
                'name' => 'username',
                'type' => Type::string(),
            ],
            'first_name' => [
                'name' => 'first_name',
                'type' => Type::string(),
            ],
            'last_name' => [
                'name' => 'last_name',
                'type' => Type::string(),
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::string(),
            ],
            'confirm_password' => [
                'name' => 'confirm_password',
                'type' => Type::string(),
            ],
            'birth_date' => [
                'name' => 'birth_date',
                'type' => Type::string(),
            ],
            'city' => [
                'name' => 'city',
                'type' => Type::string(),
            ],
            'region' => [
                'name' => 'region',
                'type' => Type::string(),
            ],
            'country' => [
                'name' => 'country',
                'type' => Type::string(),
            ],
            'country_code' => [
                'name' => 'country_code',
                'type' => Type::string(),
            ],
            'user_pic' => [
                'name' => 'user_pic',
                'type' => Type::string()
            ],
            'user_pic_original' => [
                'name' => 'user_pic_original',
                'type' => Type::string()
            ],
            'social' => [
                'name' => 'social',
                'type' => Type::string()
            ],
            'social_id' => [
                'name' => 'social_id',
                'type' => Type::string()
            ],
            'social_token' => [
                'name' => 'social_token',
                'type' => Type::string()
            ],
            'inviting_business_id' => [
                'name' => 'inviting_business_id',
                'type' => Type::string(),
            ],
            'gender' => [
                'name' => 'gender',
                'type' => Type::string()
            ],
            'language' => [
                'name' => 'language',
                'type' => Type::int()
            ],
            'invite' => [
                'name' => 'invite',
                'type' => Type::string()
            ],
            'affiliate_token' => [
                'name' => 'affiliate_token',
                'type' => Type::string()
            ],
            'f_business' => [
                'name' => 'f_business',
                'type' => Type::int()
            ],
            'type' => [
                'name' => 'type',
                'type' => Type::string()
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
        $this->credentials = [
            'email' => $args['email'],
            'password' => $args['password']
        ];

        if (isset($args['invite'])) {
            $user = User::where('invite_token', $args['invite'])->first();

            if (!$user) {
                throw new UnauthorizedHttpException('auth', 'Wrong Invitation code!');
            }

            $rules = [
                'username' => ['unique:users,username,' . $user['id'], 'regex:/(^([a-zA-Z0-9]+)(\d+)?$)/u'],
                'email' => ['unique:users,email,' . $user['id']],
                'first_name' => ['string'],
                'last_name' => ['string'],
                'password' => ['required', 'min:6', 'max:12'],
                'confirm_password' => ['required', 'required_with:password', 'same:password', 'min:6', 'max:12']
            ];

            //set rules after authorize
            $validator = $this->getValidator($args, $rules);

            if ($validator->fails()) {
                throw with(new ValidationError('validation'))->setValidator($validator);
            }
        } else {
            $rules = [
                'username' => ['required', 'string', 'unique:users,username', 'regex:/(^([a-zA-Z0-9]+)(\d+)?$)/u'],
                'email' => ['required', 'string', 'unique:users,email'],
                'first_name' => ['required', 'string'],
                'last_name' => ['required', 'string'],
                'password' => ['required', 'min:6', 'max:12'],
                'confirm_password' => ['required', 'required_with:password', 'same:password', 'min:6', 'max:12']
            ];

            //set rules after authorize
            $validator = $this->getValidator($args, $rules);

            if ($validator->fails()) {
                throw with(new ValidationError('validation'))->setValidator($validator);
            }
        }

        return [ 'response' => 'ok' ];
    }
}
