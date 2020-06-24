<?php

namespace App\GraphQL\Mutation\User;

use App\Mail\VerificationUser;
use App\User;
use App\User\Academy\Director;
use App\User\Academy\Teacher;
use App\User\Resume\Availability;
use App\User\Resume\BasicInfo;
use App\User\Resume\Preference;
use App\UserSocials;
use Folklore\GraphQL\Error\ValidationError;
use GraphQL;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class CreateUserAcademyMutation extends Mutation
{
    protected $attributes = [
        'name' => 'newUserAcademy'
    ];
    
    public function type()
    {
        return GraphQL::type('UserAcademy');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'teaching' => ['required', 'string'],
            'academy' => ['required', 'string'],
            'password' => ['required', 'min:6', 'max:12'],
            'confirm_password' => ['required', 'required_with:password', 'same:password', 'min:6', 'max:12']
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'token' => [
                'name' => 'token',
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
            'teaching' => [
                'name' => 'teaching',
                'type' => Type::string(),
            ],
            'academy' => [
                'name' => 'academy',
                'type' => Type::string(),
            ],
            'username' => [
                'name' => 'username',
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
            'type' => [
                'name' => 'type',
                'type' => Type::nonNull(Type::string()),
            ]
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args)
    {
        $redirect = '/' . $args['type'] . '/';
        /*DB::beginTransaction();
        try {*/
            $args['password'] = bcrypt($args['password']);
            $data = [];
            if (!$user = User::where('email',$args['email'])->first()) {
                $rules = [
                    'username' => ['unique:users,username', 'regex:/(^([a-zA-Z0-9]+)(\d+)?$)/u'],
                ];
                $validator = $this->getValidator($args, $rules);
                if ($validator->fails()) {
                    throw with(new ValidationError('validation'))->setValidator($validator);
                }
                //---create user for CloudResume
                foreach ($args as $k => $v) {
                    if ($k !== 'social' && $k !== 'social_id' && $k !== 'social_token') {
                        $data[$k] = $v;
                    }
                }
                $data['verification_code'] = md5(str_random(32));
                $data['verification_date'] = time();
                $user = User::create($data);
                if ($user) {
                    if (isset($args['social'])) {
                        $userSocial = new UserSocials();
                        $userSocial->user_id = $user['id'];
                        $userSocial->social_id = $args['social_id'];
                        $userSocial->social = $args['social'];
                        $userSocial->social_token = $args['social_token'];
                        $userSocial->save();
                    }
                    Mail::to($user->email)
                        ->queue(new VerificationUser($user, $this->auth->language_prefix));

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

                    if (isset($args['user_pic_original']) && !empty($args['user_pic_original'])) {
                        try {
                            ini_set('memory_limit', '-1');
                            $fileName = md5('user-resume-pic-' . $user->id);
                            $storage = 'user/' . $user->id . '/resume/';
                            $originalImage = $fileName . '.jpg';
                            //save original image
                            $url = $args['user_pic_original'];
                            $contents = file_get_contents($url);
                            Storage::put($storage . $originalImage, $contents);


                            //create image crop by user crop area
                            $cropImage = Image::make($contents)->orientate();
                            Storage::put($storage . 'crop_' . $originalImage, $cropImage->encode());
                            //create thumbnail 200x200
                            $cropImage->resize(200, 200);
                            Storage::put($storage . '200.200.' . $originalImage, $cropImage->encode());
                            //create thumbnail 100x100
                            $cropImage->resize(100, 100);
                            Storage::put($storage . '100.100.' . $originalImage, $cropImage->encode());
                            //create thumbnail 50x50
                            $cropImage->resize(50, 50);
                            Storage::put($storage . '50.50.' . $originalImage, $cropImage->encode());

                            $data = [];
                            $data['user_pic'] = $originalImage;
                            $data['user_pic_original'] = $originalImage;
                            $data['user_pic_custom'] = 1;
                            $data['user_pic_filter'] = '';
                            foreach ($data as $field => $value) {
                                $user->{$field} = $value;
                            }
                            $user->save();
                        } catch (\Exception $e) {
                        }
                    }
                }
            }
            foreach ($args as $k => $v) {
                if ($k != 'email') {
                    $data[$k] = $v;
                }
            }
            $data['user_id'] = $user->id;
            if ($args['type'] == 'teacher') {
                if ($userAcademy = Teacher::where('email', $args['email'])->first()) {
                    if (!$userAcademy->token) {
                        $userAcademy->update($data);
                    } else {
                        throw new UnauthorizedHttpException('auth', ucfirst($args['type']) . ' with email is already registered!');
                    }
                } else {
                    $data['email'] = $args['email'];
                    $userAcademy = Teacher::create($data);
                }
            } else {
                if ($userAcademy = Director::where('email', $args['email'])->first()) {
                    if (!$userAcademy->token) {
                        $userAcademy->update($data);
                    } else {
                        throw new UnauthorizedHttpException('auth', ucfirst($args['type']) . ' with email is already registered!');
                    }
                } else {
                    $data['email'] = $args['email'];
                    $userAcademy = Director::create($data);
                }
            }
        /*    DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return null;
        }*/

        $userAcademy['redirect'] = $redirect . $userAcademy->token;
        header("Set-Cookie: api-user_social_data=; EXPIRES 1;path=/");
        return $userAcademy;
    }
}
