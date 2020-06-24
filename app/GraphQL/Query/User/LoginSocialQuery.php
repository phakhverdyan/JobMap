<?php

namespace App\GraphQL\Query\User;

use App\GraphQL\AuthToken;
use App\User;
use App\UserSocials;
use Folklore\GraphQL\Support\Traits\ShouldValidate;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginSocialQuery extends Query
{
    use AuthToken;

    use ShouldValidate;

    protected $attributes = [
        'name' => 'token'
    ];

    public function type()
    {
        return GraphQL::type('LoginSocial');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'client' => ['required', 'string'],
            'provider' => ['required', 'string']
        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'client' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'oAuth token'
            ],
            'provider' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Social provider'
            ],
            'type' => [
                'type' => Type::string(),
                'description' => 'typelogib user'
            ],
        ];
    }

    protected function findUser($email, $data, $provider)
    {
        $where = ['email' => $email];
        $user = User::where($where)->first();
        if ($user) {
            $userSocial = UserSocials::where([
                'user_id' => $user['id'],
                'social' => $provider
            ])->first();
            if ($userSocial) {
                UserSocials::where([
                    'user_id' => $user['id'],
                    'social' => $provider
                ])->update([
                    'social_id' => $data['id'],
                    'social_token' => $data->token
                ]);
            } else {
                $userSocial = new UserSocials();
                $userSocial->user_id = $user['id'];
                $userSocial->social_id = $data['id'];
                $userSocial->social = $provider;
                $userSocial->social_token = $data->token;
                $userSocial->save();
            }
            if ($user['invite_token'] != null) {
                return [
                    'redirect' => 'user.signup',
                    'i' => $user['invite_token']
                ];
            } else {
                $token = JWTAuth::fromUser($user);
                if ($token) {
                    header("Set-Cookie: api-token=" . $token . "; Domain=" . env('SESSION_DOMAIN') . "; EXPIRES 129600;path=/");
                    if ($user['last_active_business']) {
                        return [
                            'redirect' => 'business.applicants',
                            'token' => $token,
                            'b_id' => $user['last_active_business']
                        ];
                    } elseif (!($user['preference']['is_complete'] === 1 && $user['availability']['is_complete'] === 1 && $user['basic']['is_complete'] === 1
                            && ($user['preference']['not_education'] || $user['education']->count() > 0) && ($user['preference']['first_job'] !== null || $user['experience']->count() > 0))
                        && !$user['attach_file']) {
                        return [
                            'redirect' => 'user.resume.create',
                            'token' => $token
                        ];
                    } else {
                        return [
                            'redirect' => 'user.dashboard',
                            'token' => $token
                        ];
                    }
                }
            }
        }

        return false;
    }

    /**
     * @param $root
     * @param $args
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function resolve($root, $args)
    {
        $provider = $args['provider'];
        switch ($provider) {
            case 'facebook':
                $user = Socialite::driver($provider)->fields([
                    'name',
                    'first_name',
                    'last_name',
                    'email',
                    'gender',
                    'verified',
                    'birthday'
                ])->userFromToken($args['client']);
                //$data = $this->findUser($user['email'], $user, $provider);
                //$data = (empty($args['type']) || $args['type'] == 'student') ? $this->findUser($user['email'], $user, $provider) : false;
                $data = (empty($args['type']) || !in_array($args['type'], [ 'teacher', 'director' ])) ? $this->findUser($user->email, $user, $provider) : false;
                if ($data) {
                    if (isset($data['token'])) {
                        $param = (isset($data['b_id'])) ? '?b_id=' . $data['b_id'] : '';
                        $token = $data['token'];
                        $bID = $data['b_id'] ?? null;
                        $redirect = route($data['redirect']) . $param;
                    } else {
                        $param = '?i=' . $data['i'];
                        $token = null;
                        $bID = null;
                        $redirect = route($data['redirect']) . $param;
                    }

                    return [
                        'token' => $token,
                        'redirect' => $redirect,
                        'last_active_business' => $bID,
                        'social_user_data' => [
                            'social' => $provider,
                            'id' => $user['id'],
                            'token' => $user->token
                        ]
                    ];
                }

                $firstName = $user['first_name'] ?? "";
                $lastName = $user['last_name'] ?? "";
                $birthday = $user['birthday'] ?? "";
                $email = $user['email'] ?? "";
                $userData['birthday'] = $birthday;
                break;
            case 'google':
                $user = Socialite::driver($provider)->userFromToken($args['client']);
                //$data = $this->findUser($user->email, $user, $provider);
                //$data = (empty($args['type']) || $args['type'] == 'student') ? $this->findUser($user->email, $user, $provider) : false;
                $data = (empty($args['type']) || !in_array($args['type'], [ 'teacher', 'director' ])) ? $this->findUser($user->email, $user, $provider) : false;
                if ($data) {
                    if (isset($data['token'])) {
                        $param = (isset($data['b_id'])) ? '?b_id=' . $data['b_id'] : '';
                        $token = $data['token'];
                        $bID = $data['b_id'] ?? null;
                        $redirect = route($data['redirect']) . $param;
                    } else {
                        $param = '?i=' . $data['i'];
                        $token = null;
                        $bID = null;
                        $redirect = route($data['redirect']) . $param;
                    }

                    return [
                        'token' => $token,
                        'redirect' => $redirect,
                        'last_active_business' => $bID,
                        'social_user_data' => [
                            'social' => $provider,
                            'id' => $user['id'],
                            'token' => $user->token
                        ]
                    ];
                }
                $firstName = $user->user['name']['givenName'] ?? "";
                $lastName = $user->user['name']['familyName'] ?? "";
                $email = $user->email;
                break;
            default:
                return null;
                break;
        }
        $userData['id'] = $user['id'] ?? "";
        $userData['email'] = $email;
        $userData['first_name'] = $firstName;
        $userData['last_name'] = $lastName;
        $userData['gender'] = $user['gender'] ?? "";
        $userData['userpic'] = $user->avatar ?? "";
        $userData['userpic_original'] = $user->avatar_original ?? "";
        $userData['token'] = $user->token;
        $userData['social'] = $provider;
        $token = null;
        if (empty($type) || !in_array($args['type'], [ 'teacher', 'director' ])) {
        //if (empty($args['type']) || $args['type'] == 'student') {
            $redirect = route('user.signup', ['social' => $provider]);
        } else {
            $redirect = route('landing.' . $args['type'] . '.signup', ['social' => $provider]);
        }


        // all good so return the token
        return [
            'token' => $token,
            'redirect' => $redirect,
            'last_active_business' => null,
            'social_user_data' => $userData
        ];
    }
}
