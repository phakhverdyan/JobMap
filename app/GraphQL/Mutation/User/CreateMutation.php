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

class CreateMutation extends Mutation
{
    use AuthToken;

    protected $attributes = [
        'name' => 'newUser'
    ];

    public function type()
    {
        return GraphQL::type('User');
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
        $language = \App\Language::where('id', $args['language'])->first();
        unset($args['language']);
        $args['language_prefix'] = ($language ? $language->prefix : 'en');

        $this->credentials = [
            'email' => $args['email'],
            'password' => $args['password']
        ];

        $user = false;

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

        $args['password'] = bcrypt($args['password']);
        DB::beginTransaction();

        if (isset($args['invite'])) {
            $args['invite_token'] = null;
            unset($args['confirm_password']);
            unset($args['invite']);
            $update = [];

            foreach ($args as $k => $v) {
                if (
                    $k !== 'social'
                    &&
                    $k !== 'social_id'
                    &&
                    $k !== 'social_token'
                    &&
                    $k !== 'inviting_business_id'
                ) {
                    $update[$k] = $v;
                }
            }

            User::where('id', $user['id'])->update($update);
            $user = User::where('id', $user['id'])->first();

            if (isset($args['social'])) {
                $userSocial = UserSocials::where([
                    'user_id' => $user['id'],
                    'social' => $args['social']
                ])->first();

                if ($userSocial) {
                    UserSocials::where([
                        'user_id' => $user['id'],
                        'social' => $args['social']
                    ])->update([
                        'social_id' => $args['social_id'],
                        'social_token' => $args['social_token']
                    ]);
                } else {
                    $userSocial = new UserSocials();
                    $userSocial->user_id = $user['id'];
                    $userSocial->social_id = $args['social_id'];
                    $userSocial->social = $args['social'];
                    $userSocial->social_token = $args['social_token'];
                    $userSocial->save();
                }
            }

            $businessUser = User::where([
                'id' => $user['invite_user_id']
            ])->first();

            $business = \App\Business::where('id', $user['invite_business_id'])->first();

            if (\App\Business\Administrator::where('business_id', $user['invite_business_id'])->where('user_id', $user->id)->first()) {
                Mail::to($businessUser['email'])->queue(new \App\Mail\ManagerWasCreated($business, $user, 'INITIAL', $this->auth->language_prefix));
            }
            else {
                Mail::to($businessUser['email'])->queue(new BusinessNotifications($user, 'ACCEPT_INVITE', [], $this->auth->language_prefix));
            }

            Mail::to($user->email)->queue(new \App\Mail\ManagerCongratulation($user, 'INITIAL', $this->auth->language_prefix));
        }
        else {
            $create = [];

            foreach ($args as $k => $v) {
                if ($k !== 'social' && $k !== 'social_id' && $k !== 'social_token') {
                    $create[$k] = $v;
                }
            }

            $create['verification_code'] = md5(str_random(32));
            $create['verification_date'] = time();
            $create['show_tooltip'] = 'on';
            $user = User::create($create);

            if (!$user) {
                return null;
            }

            if (isset($args['social'])) {
                $userSocial = new UserSocials();
                $userSocial->user_id = $user['id'];
                $userSocial->social_id = $args['social_id'];
                $userSocial->social = $args['social'];
                $userSocial->social_token = $args['social_token'];
                $userSocial->save();
            }

            $importAts = Import::where('email', $user->email)->get();

            foreach ($importAts as $import) {
                $candidate = new Candidate;
                $candidate->user_id = $user->id;
                $candidate->business_id = $import->business_id;
                $candidate->pipeline = 'invited';
                $candidate->save();

                $import->status = 'Exist';
                $import->affiliate_token = '';
                $import->save();
            }

            Mail::to($user->email)->queue(new VerificationUser($user, $this->auth->language_prefix));

            if (isset($args['inviting_business_id'])) {
                $inviting_business_id = strval($args['inviting_business_id']);
                $inviting_business = \App\Business::where('id', $inviting_business_id)->first();

                if ($inviting_business) {
                    if (!$invited_candidate = \App\Candidate\Candidate::where('business_id', $inviting_business->id)->where('user_id', $user->id)->first()) {
                        $invited_candidate = new \App\Candidate\Candidate;
                        $invited_candidate->user_id = $user->id;
                        $invited_candidate->business_id = $inviting_business->id;
                    }

                    $invited_candidate->pipeline = 'interested';
                    $invited_candidate->save();
                }
            }
        }

        try {
            $userPreference = new Preference();
            $userPreference->user_id = $user['id'];
            $userPreference->save();

            $userAvailability = new Availability();
            $userAvailability->user_id = $user['id'];
            $userAvailability->save();

            $userBasicInfo = new BasicInfo();
            $userBasicInfo->user_id = $user['id'];
            $userBasicInfo->headline = "";
            $userBasicInfo->about = "";
            $userBasicInfo->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return null;
        }

        // Mail::to(env('TEAM_EMAIL', 'atom-danil@yandex.ru'))->queue(new \App\Mail\UserCreated($user));
        $user['token'] = $this->getToken();
        return $user;
    }
}
