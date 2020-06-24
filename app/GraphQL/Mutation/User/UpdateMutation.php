<?php

namespace App\GraphQL\Mutation\User;

use App\GraphQL\Auth;
use App\Rules\CheckValidGeo;
use App\UserSocials;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Folklore\GraphQL\Error\ValidationError;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Mockery\Exception;

class UpdateMutation extends Mutation
{
    //use JWT authorization
    use Auth;

    protected $attributes = [
        'name' => 'UpdateUser'
    ];

    public function type()
    {
        return GraphQL::type('User');
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
            'gender' => [
                'name' => 'gender',
                'type' => Type::string()
            ],
            'is_online' => [
                'name' => 'is_online',
                'type' => Type::int()
            ],
            'last_active_business' => [
                'type' => Type::int(),
                'description' => 'Last Active Business'
            ],
            'language_prefix' => [
                'name' => 'language_prefix',
                'type' => Type::string()
            ]
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return null
     */
    public function resolve($root, $args)
    {
        $errorMessage = '';
        //update only basic user_pic if isset image
        if (Input::hasFile('avatar_file')) {
            if (Input::file('avatar_file')->isValid()) {
                try {
                    ini_set('memory_limit', '-1');
                    $imageCropData = \GuzzleHttp\json_decode(Input::get('avatar_data'));
                    $inputImage = Input::file('avatar_file');
                    if ($inputImage->getClientSize() < 24000000) {
                        $ext = $inputImage->getClientOriginalExtension();
                        $fileName = md5('user-resume-pic-' . $this->auth->id);
                        $storage = 'user/' . $this->auth->id . '/resume/';
                        $originalImage = $fileName . '.' . $ext;
                        //save original image
                        $inputImage->storeAs($storage, $originalImage);

                        //create image crop by user crop area
                        $cropImage = Image::make($inputImage->getRealPath())->orientate();
                        $cropImage->crop((int)$imageCropData->width, (int)$imageCropData->height, (int)$imageCropData->x, (int)$imageCropData->y);
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

                        $args['user_pic'] = $originalImage;
                        $args['user_pic_original'] = $originalImage;
                        $args['user_pic_custom'] = 1;
                        $args['user_pic_filter'] = Input::get('filter');
                    } else {
                        $args['user_pic'] = '';
                        $args['user_pic_original'] = '';
                        $args['user_pic_custom'] = 0;
                        $args['user_pic_filter'] = '';
                        $errorMessage = $inputImage->getClientSize() . 'byte';
                    }

                } catch (Exception $e) {
                    $args['user_pic'] = '';
                    $args['user_pic_original'] = '';
                    $args['user_pic_custom'] = 0;
                    $args['user_pic_filter'] = '';
                }
            }
        } else if (Input::get('avatar_data')) {
            try {
                ini_set('memory_limit', '-1');

                $imageCropData = \GuzzleHttp\json_decode(Input::get('avatar_data'));
                $user = User::where('id', $this->auth->id)->first();
                $storage = 'user/' . $this->auth->id . '/resume/';
                $fileInfo = pathinfo($storage . $user['user_pic']);
                $ext = $fileInfo['extension'];
                $fileName = $fileInfo['filename'];
                $originalImage = $fileName . '.' . $ext;

                //create image crop by user crop area
                $cropImage = Image::make(Storage::get($storage . $originalImage))->orientate();
                $cropImage->crop((int)$imageCropData->width, (int)$imageCropData->height, (int)$imageCropData->x, (int)$imageCropData->y);
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

                $args['user_pic'] = $originalImage;
                $args['user_pic_original'] = $originalImage;
                $args['user_pic_custom'] = 1;
                $args['user_pic_filter'] = Input::get('filter');
            } catch (Exception $e) {
                $args['user_pic'] = '';
                $args['user_pic_original'] = '';
                $args['user_pic_custom'] = 0;
                $args['user_pic_filter'] = '';
            }
        } else if (Input::has('filter')) {
            $args['user_pic_filter'] = Input::get('filter');
        } else if (isset($args['user_pic_original']) && !empty($args['user_pic_original'])) {
            try {
                ini_set('memory_limit', '-1');
                $fileName = md5('user-resume-pic-' . $this->auth->id);
                $storage = 'user/' . $this->auth->id . '/resume/';
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

                $args['user_pic'] = $originalImage;
                $args['user_pic_original'] = $originalImage;
                $args['user_pic_custom'] = 1;
                $args['user_pic_filter'] = '';
            } catch (Exception $e) {
                $args['user_pic_custom'] = 0;
                $args['user_pic_filter'] = '';
            }
        } elseif (Input::hasFile('attach_file')) {
            if (Input::file('attach_file')->isValid()) {
                try {
                    ini_set('memory_limit', '-1');
                    $inputImage = Input::file('attach_file');
                    if ($inputImage->getClientSize() < 10000000) {
                        //$ext = $inputImage->getClientOriginalExtension();
                        //$fileName = md5('user-resume-attach-' . $this->auth->id);
                        $fileName = $inputImage->getClientOriginalName();
                        $storage = 'user/' . $this->auth->id . '/resume/';
                        $originalImage = $fileName;// . '.' . $ext;
                        $inputImage->storeAs($storage, $originalImage);

                        $user = User::find($this->auth->id);
                        $user->attach_file = $originalImage;
                        $user->save();
                    } else {
                        $errorMessage = $inputImage->getClientSize() . 'byte';
                    }

                } catch (Exception $e) {

                }
            }
        } else {
            $rules = [
                'username' => ['unique:users,username,' . $this->auth->id, 'regex:/(^([a-zA-Z0-9]+)(\d+)?$)/u'],
                'email' => ['unique:users,email,' . $this->auth->id],
                'first_name' => ['string'],
                'last_name' => ['string'],
            ];

            if (isset($args['city'])) {
                $rules['city'] = ['required', 'string', new CheckValidGeo()];
            }

            if (isset($args['birth_date'])) {
                $rules['birth_date'] = ['required', 'string', 'date'];
            }

            //set rules after authorize
            $validator = $this->getValidator($args, $rules);
            if ($validator->fails()) {
                throw with(new ValidationError('validation'))->setValidator($validator);
            }
        }

        $user = User::find($this->auth->id);
        if (!$user) {
            return null;
        }
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
        foreach ($args as $field => $value) {
            if ($field === 'last_active_business')
                $user->{$field} = $value;

            if (!empty($value)) {
                if ($field !== 'social' && $field !== 'social_id' && $field !== 'social_token') {
                    $user->{$field} = $value;
                }
            }
        }
        $user->save();

        if (strlen($errorMessage) > 0) {
            $user['error_message'] = $errorMessage;
        }
        $user['token'] = $this->token;

        return $user;
    }
}
