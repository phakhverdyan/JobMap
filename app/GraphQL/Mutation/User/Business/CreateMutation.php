<?php

namespace App\GraphQL\Mutation\User\Business;

use App\Business\Administrator;
use App\Business\AdministratorPermission;
use App\Business\LocationAmenity;
use App\Business\ManagerLocation;
use App\GraphQL\Auth;
use App\Business;
use App\Keyword;
use App\Rules\CheckValidGeo;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Mail;

class CreateMutation extends Mutation
{
    //use JWT authorization
    use Auth;

    protected $accessToken = 'a8eafaa7375b3be61f6a1bb93f36b319705e8e80';

    protected $attributes = [
        'name' => 'New User Business'
    ];

    public function type()
    {
        return GraphQL::type('Business');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'name' => ['required_without:name_fr', 'string'],
            'name_fr' => ['required_without:name', 'string'],
            'description' => ['required_without:description_fr', 'string'],
            'description_fr' => ['required_without:description', 'string'],
            //'industry_id' => ['required', 'not_in:0'],
            'industries' => ['string'],
            'industry' => ['string'],
            'size_id' => ['required'],
            'street' => ['required', 'string', new CheckValidGeo()],
            'street_number' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'zip_code' => ['string'],
            'city' => ['required', 'string', new CheckValidGeo()],
            'type' => ['required', 'string'],
            'language_prefix' => ['required', 'string'],
        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of business'
            ],
            'name_fr' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of business FR'
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The description of business'
            ],
            'description_fr' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The description of business FR'
            ],
            /*'industry_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The industry of business'
            ],*/
            'industries' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The industries of business'
            ],
            'industry' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The industry of business'
            ],
            'sub_industry_id' => [
                'type' => Type::int(),
                'description' => 'The sub-industry of business'
            ],
            'size_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Business size'
            ],
            'type' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Business type'
            ],
            'website' => [
                'type' => Type::string(),
                'description' => 'The website of business'
            ],
            'website_fr' => [
                'type' => Type::string(),
                'description' => 'The website of business FR'
            ],
            'direct_link' => [
                'type' => Type::string(),
                'description' => 'The direct link of business'
            ],
            'street' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Business Street'
            ],
            'street_number' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Business Street number'
            ],
            'suite' => [
                'type' => Type::string(),
                'description' => 'Business Suite'
            ],
            'latitude' => [
                'type' => Type::float(),
                'description' => 'Location Latitude'
            ],
            'longitude' => [
                'type' => Type::float(),
                'description' => 'Location Longitude'
            ],
            'city' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Business City'
            ],
            'region' => [
                'type' => Type::string(),
                'description' => 'Business Region'
            ],
            'country' => [
                'type' => Type::string(),
                'description' => 'Business Country'
            ],
            'country_code' => [
                'type' => Type::string(),
                'description' => 'Business Country Code'
            ],
            'phone_country_code' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Business Phone Country Code'
            ],
            'phone_code' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Business Phone Code'
            ],
            'phone' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Business Phone'
            ],
            'zip_code' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Business Zip Code'
            ],
            // 'keywords' => [
            //     'type' => Type::string(),
            //     'description' => 'Keywords'
            // ],
            // 'keywords_fr' => [
            //     'type' => Type::string(),
            //     'description' => 'Keywords FR'
            // ],
            'language_prefix' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Business Main Language Prefix'
            ],
            'facebook' => [
                'type' => Type::string(),
                'description' => 'facebook'
            ],
            'facebook_fr' => [
                'type' => Type::string(),
                'description' => 'facebook FR'
            ],
            'instagram' => [
                'type' => Type::string(),
                'description' => 'instagram'
            ],
            'instagram_fr' => [
                'type' => Type::string(),
                'description' => 'instagram FR'
            ],
            'linkedin' => [
                'type' => Type::string(),
                'description' => 'linkedin'
            ],
            'linkedin_fr' => [
                'type' => Type::string(),
                'description' => 'linkedin FR'
            ],
            'twitter' => [
                'type' => Type::string(),
                'description' => 'twitter'
            ],
            'twitter_fr' => [
                'type' => Type::string(),
                'description' => 'twitter FR'
            ],
            'youtube' => [
                'type' => Type::string(),
                'description' => 'youtube'
            ],
            'youtube_fr' => [
                'type' => Type::string(),
                'description' => 'youtube FR'
            ],
            'snapchat' => [
                'type' => Type::string(),
                'description' => 'snapchat'
            ],
            'snapchat_fr' => [
                'type' => Type::string(),
                'description' => 'snapchat FR'
            ],
            // 'video' => [
            //     'type' => Type::string(),
            //     'description' => 'video'
            // ],
            // 'video_fr' => [
            //     'type' => Type::string(),
            //     'description' => 'video FR'
            // ],
            'images' => [
                'type' => Type::listOf(Type::string()),
                'description' => 'tmp_images'
            ],
            'crop_data_images' => [
                'type' => Type::listOf(Type::string()),
                'description' => 'tmp_images'
            ],
            'logo' => [
                'type' => Type::string(),
                'description' => 'logo base64'
            ],
            'logo_data' => [
                'type' => Type::string(),
                'description' => 'logo data'
            ],
            'amenities' => [
                'type' => Type::string(),
                'description' => 'Location amenities'
            ],
            'parent_id' => [
                'type' => Type::id(),
                'description' => 'Brand business'
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
        if (isset($args['parent_id'])) {
            $this->roles = [
                Administrator::MANAGER_ROLE,
                /*Administrator::BRANCH_ROLE,
                Administrator::FRANCHISE_ROLE*/
            ];
            //set permissions for this object
            $this->permissions = [
                'brands'
            ];
            //set business ID
            $this->businessID = $args['parent_id'];
            //check permissions
            $this->check();
        }

        $errorMessage = '';

        if ($b = Business::where('name', $args['name'])
                        //->where('industry_id', $args['industry_id'])
                        ->where('street', $args['street'])
                        ->where('street_number', $args['street_number'])
                        ->where('phone', $args['phone'])
                        ->where('zip_code', $args['zip_code'])
                        ->where('city', $args['city'])
                        ->first()){
            return [
                'id' => $b->id,
                'error_message' => 'business_exist',
                'token' => $this->token,
            ];
        }

        DB::beginTransaction();

        try {
            $business = new Business;

            if (isset($args['sub_industry_id']) && $args['sub_industry_id'] == 0) {
                $args['sub_industry_id'] = null;
            }

            $excluded_fields_from_update = [
                'id',
                'sub_industry_id',
                'industries',
                // 'keywords',
                // 'keywords_fr',
                'language_prefix',
                'images',
                'crop_data_images',
                'logo',
                'logo_data',
                'amenities',
            ];

             foreach ($args as $argument_name => $argument_value) {
                if (!in_array($argument_name, $excluded_fields_from_update)) {
                    $business->{$argument_name} = $argument_value;
                }
            }

            if (isset($args['name'])) {
                $business->slug = str_slug($args['name']);
            } else {
                $business->slug = str_slug($args['name_fr']);
            }

            // Save FR version if EN is empty
            if (isset($args['name_fr']) && empty($args['name'])) {
                $business->name = $args['name_fr'];
            }
            if (isset($args['description_fr']) && empty($args['description'])) {
                $business->description = $args['description_fr'];
            }
            if (!$business->slug) {
                $business->slug = str_slug($args['name_fr']);
            }

            $business->save();

            if ($code_bitly = $this->getCodeBitLyAPI($business)) {
                $business->code_bitly = $code_bitly;
                $business->save();
            }

            $business->industries()->sync(explode(",", $args['industries']));

            if (isset($this->businessID))
            {
                $admin = Administrator::where('business_id', $this->businessID)->where('user_id', $this->auth->id)->first();
            }
            else
            {
                $admin = new Administrator();
                $admin->user_id = $this->auth->id;
                $admin->business_id = $business->id;
                $admin->role = Administrator::ADMIN_ROLE;
                $admin->save();
            }


            $permissions = new AdministratorPermission();
            $permissions->administrator_id = $admin->id;
            $permissions->save();

            $location = new Business\Location();
            $location->name = $args['name'];
            $location->street = $args['street'];
            $location->street_number = $args['street_number'];
            $location->suite = ($args['suite']) ?? "";
            $location->city = $args['city'];
            $location->region = $args['region'];
            $location->country = $args['country'];
            $location->country_code = $args['country_code'];
            $location->phone_country_code = $args['phone_country_code'];
            $location->phone_code = $args['phone_code'];
            $location->phone = $args['phone'];
            $location->latitude = $args['latitude'];
            $location->longitude = $args['longitude'];
            $location->type = 'headquarter';
            $location->business_id = $business->id;
            $location->user_id = $this->auth->id;
            $location->main = 1;
            $location->save();

            $manager_location = new ManagerLocation();
            $manager_location->location_id = $location->id;
            $manager_location->administrator_id = $admin->id;
            $manager_location->timestamps = false;
            $manager_location->save();

            if (!empty($args['amenities'])) {
                $locationAmenity = new LocationAmenity();
                $amenities = explode(',', $args['amenities']);
                $dataInsert = [];
                foreach ($amenities as $amenity) {
                    $dataInsert[] = array(
                        'location_id' => $location->id,
                        'amenity_id' => $amenity
                    );
                }
                $locationAmenity->insert($dataInsert);
            }

            // $languages = [
            //     [
            //         'business_id' => $business['id'],
            //         'language_id' => $args['language_prefix'],
            //         'status' => 1,
            //     ],
            // ];

            // if (isset($args['languages']) && !empty($args['languages'])) {
            //     $langs = explode(',', $args['languages']);
            //     foreach ($langs as $lang){
            //         if($lang != $args['language']) {
            //             $languages[] = [
            //                 'business_id' => $business['id'],
            //                 'language_id' => $lang,
            //                 'status' => 0
            //             ];
            //         }
            //     }
            // }

            // $businessLanguages = new Business\Language();
            // $businessLanguages->insert($languages);

            // foreach(['en', 'fr'] as $currnet_language_prefix) {
            //     $language_injection = '';

            //     if ($currnet_language_prefix != 'en') {
            //         $language_injection = '_' . $currnet_language_prefix;
            //     }

            //     if (isset($args['keywords' . $language_injection]) && !empty($args['keywords' . $language_injection])) {
            //         $business_keywords = new Business\Keyword;
            //         $args_keywords = explode(',', $args['keywords' . $language_injection]);
            //         $business_keywords_data_to_insert = [];

            //         foreach ($args_keywords as $args_keyword_id_or_name) {
            //             if (!$keyword = Keyword::where('id', $args_keyword_id_or_name)->first()) {
            //                 $keyword = new Keyword;
            //                 $keyword->name = $args_keyword_id_or_name;
            //                 $keyword->language_prefix = $currnet_language_prefix;
            //                 $keyword->save();
            //             }

            //             $business_keywords_data_to_insert[] = [
            //                 'business_id' => $business->id,
            //                 'keyword_id' => $keyword->id,
            //             ];
            //         }

            //         $business_keywords->insert($business_keywords_data_to_insert);
            //     }
            // }

            $pipelineDefault = [
                [
                    'business_id' => $business->id,
                    'name' => trans('db.pipelines.invited', [], 'en'),
                    'name_fr' => trans('db.pipelines.invited', [], 'fr'),
                    'type' => 'ats',
                    'icon' => 'import',
                    'type_new' => 'invited',
                    'not_delete' => true,
                    'position' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'business_id' => $business->id,
                    'name' => trans('db.pipelines.new', [], 'en'),
                    'name_fr' => trans('db.pipelines.new', [], 'fr'),
                    'type' => 'new',
                    'icon' => 'job',
                    'type_new' => 'new',
                    'not_delete' => true,
                    'position' => 2,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                /*[
                    'business_id' => $business->id,
                    'name' => trans('db.pipelines.viewed', [], 'en'),
                    'name_fr' => trans('db.pipelines.viewed', [], 'fr'),
                    'type' => 'viewed',
                    'icon' => 'visible',
                    'type_new' => 'viewed',
                    'not_delete' => true,
                    'position' => 3,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],*/
                [
                    'business_id' => $business->id,
                    'name' => trans('db.pipelines.contacted', [], 'en'),
                    'name_fr' => trans('db.pipelines.contacted', [], 'fr'),
                    'type' => 'contacted',
                    'icon' => 'phone-call',
                    'type_new' => 'contacted',
                    'not_delete' => true,
                    'position' => 4,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                /*[
                    'business_id' => $business->id,
                    'name' => trans('db.pipelines.to_interview', [], 'en'),
                    'name_fr' => trans('db.pipelines.to_interview', [], 'fr'),
                    'type' => 'to_iterview',
                    'icon' => 'interview',
                    'type_new' => 'to_iterview',
                    'not_delete' => true,
                    'position' => 5,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],*/
                [
                    'business_id' => $business->id,
                    'name' => trans('db.pipelines.interviewed', [], 'en'),
                    'name_fr' => trans('db.pipelines.interviewed', [], 'fr'),
                    'type' => 'custom',
                    'icon' => 'hired',
                    'type_new' => 'custom',
                    'not_delete' => false,
                    'position' => 6,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'business_id' => $business->id,
                    'name' => trans('db.pipelines.offer_mode', [], 'en'),
                    'name_fr' => trans('db.pipelines.offer_mode', [], 'fr'),
                    'type' => 'custom',
                    'icon' => 'sharing',
                    'type_new' => 'custom',
                    'not_delete' => false,
                    'position' => 7,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'business_id' => $business->id,
                    'name' =>  trans('db.pipelines.hired', [], 'en'),
                    'name_fr' =>  trans('db.pipelines.hired', [], 'fr'),
                    'type' => 'hired',
                    'icon' => 'deal',
                    'type_new' => 'hired',
                    'not_delete' => false,
                    'position' => 8,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'business_id' => $business->id,
                    'name' =>  trans('db.pipelines.rejected', [], 'en'),
                    'name_fr' =>  trans('db.pipelines.rejected', [], 'fr'),
                    'type' => 'rejected',
                    'icon' => 'archived',
                    'type_new' => 'rejected',
                    'not_delete' => false,
                    'position' => 9,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            ];

            $pipeline = new Business\Pipeline();
            $pipeline->insert($pipelineDefault);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return null;
        }

        // Mail::to(env('TEAM_EMAIL', 'atom-danil@yandex.ru'))->queue(new \App\Mail\BusinessCreated($business));
        Mail::to($this->auth->email)->queue(new \App\Mail\BusinessCompletedAccount($business, 'INITIAL', $this->auth->language_prefix));

        //save picture if exist
        if (Input::hasFile('avatar_file')) {
            if (Input::file('avatar_file')->isValid()) {
                try {
                    ini_set('memory_limit', '-1');
                    $imageCropData = \GuzzleHttp\json_decode(Input::get('avatar_data'));
                    $inputImage = Input::file('avatar_file');
                    if ($inputImage->getClientSize() < 24500000) {
                        $ext = $inputImage->getClientOriginalExtension();
                        $fileName = md5('business-picture-' . $business->id);
                        $storage = 'business/' . $business->id . '/logo/';
                        $originalImage = $fileName . '.' . $ext;
                        //save original image
                        $inputImage->storeAs($storage, $originalImage);

                        //create image crop by user crop area
                        $cropImage = Image::make($inputImage->getRealPath())->orientate();
                        $cropImage->crop((int)$imageCropData->width, (int)$imageCropData->height, (int)$imageCropData->x, (int)$imageCropData->y);
                        //$encode = $cropImage->encode();
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

                        Business::where([
                            'id' => $business->id
                        ])->update([
                            'picture' => $originalImage
                        ]);
                    } else {
                        $errorMessage = $inputImage->getClientSize() . 'byte';
                    }

                } catch (Exception $e) {

                }
            }
        }

        if (strlen($args['logo']) && strlen($args['logo_data'])) {
            try {
                ini_set('memory_limit', '-1');
                $image = $args['logo'];
                // $image = substr($image, strpos($image, ",")+1);
                $fileName = md5('business-picture-' . $business->id);
                $storage = 'business/' . $business->id . '/logo/';
                $originalImage = $fileName . '.png';

                Storage::makeDirectory($storage, 0775, true, true);
                $image = Image::make($image)->orientate()->encode('png');
                $image->save(Storage::path($storage . $originalImage));
                //Image::make(file_get_contents($image))->save($storage . $originalImage);

                //$success = file_put_contents($storage . 'crop_' . $originalImage, $image);
                // $success = file_put_contents($storage . $originalImage, $image);

                $imageCropData = \GuzzleHttp\json_decode($args['logo_data']);
                $storage = 'business/' . $business->id . '/logo/';
                //create image crop by user crop area
                $cropImage = Image::make(Storage::get($storage . $originalImage))->encode('png');
                $cropImage->crop((int)$imageCropData->width, (int)$imageCropData->height, (int)$imageCropData->x, (int)$imageCropData->y);
                //$encode = $cropImage->encode();
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

                Business::where([
                    'id' => $business->id
                ])->update([
                    'picture' => $originalImage
                ]);

            } catch (Exception $e) {

            }
        }

        //save bg_picture if exist
        /*if (Input::hasFile('business_bg_file')) {
            if (Input::file('business_bg_file')->isValid()) {
                try {
                    ini_set('memory_limit', '-1');
                    $imageCropData = \GuzzleHttp\json_decode(Input::get('business_bg_data'));
                    $inputImage = Input::file('business_bg_file');
                    if ($inputImage->getClientSize() < 24500000) {
                        $ext = $inputImage->getClientOriginalExtension();
                        $fileName = md5('business-bg-picture-' . $business->id);
                        $storage = 'business/' . $business->id . '/logo/';
                        $originalImage = $fileName . '.' . $ext;
                        //save original image
                        $inputImage->storeAs($storage, $originalImage);

                        //create image crop by user crop area
                        $cropImage = Image::make($inputImage->getRealPath())->orientate();
                        $cropImage->crop((int)$imageCropData->width, (int)$imageCropData->height, (int)$imageCropData->x, (int)$imageCropData->y);
                        Storage::put($storage . 'crop_' . $originalImage, $cropImage->encode());

                        Business::where([
                            'id' => $business->id
                        ])->update([
                            'bg_picture' => $originalImage
                        ]);
                    } else {
                        $errorMessage = $inputImage->getClientSize() . 'byte';
                    }

                } catch (Exception $e) {

                }
            }
        }*/
        if (isset($args['images']) && count($args['images']) > 0 && $args['crop_data_images'] && count($args['crop_data_images']) > 0) {
            try {
                ini_set('memory_limit', '-1');

                foreach ($args['images'] as $ind => $image) {
                    $image = substr($image, strpos($image, ",")+1);
                    $image = base64_decode($image);
                    $fileName = md5('business-bg-picture-' . $business->id . $ind . time());
                    $storage = storage_path() . '/app/business/' . $business->id . '/logo/';
                    $originalImage = $fileName . '.png';

                    Storage::disk('business')->makeDirectory($business->id . '/logo');
                    //Image::make(file_get_contents($image))->save($storage . $originalImage);

                    //$success = file_put_contents($storage . 'crop_' . $originalImage, $image);
                    $success = file_put_contents($storage . $originalImage, $image);

                    $imgBus = $business->images()->create([
                        'bg_picture' => $originalImage,
                        'number' => $ind +1,
                    ]);

                    $imageCropData = \GuzzleHttp\json_decode($args['crop_data_images'][$ind]);
                    $storage = 'business/' . $business->id . '/logo/';
                    //create image crop by user crop area
                    $cropImage = Image::make(Storage::get($storage . $originalImage))->orientate();
                    $cropImage->crop((int)$imageCropData->width, (int)$imageCropData->height, (int)$imageCropData->x, (int)$imageCropData->y);
                    Storage::put($storage . 'crop_' . $originalImage, $cropImage->encode());

                }
            } catch (Exception $e) {

            }
        }


        if (strlen($errorMessage) > 0) {
            $business = Business::find($business->id);
            $business['error_message'] = $errorMessage;
        }


        $business['token'] = $this->token;
        return $business;
    }

    protected function getCodeBitLyAPI ($data)
    {
        $longUrl = url("business/view/$data->id/$data->slug");
        $code_bitly = null;
        if( $curl = curl_init() ) {
            curl_setopt($curl, CURLOPT_URL, 'https://api-ssl.bitly.com/v3/shorten');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            //curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, "access_token=$this->accessToken&longUrl=$longUrl");
            $code_bitly = json_decode(curl_exec($curl))->data->url;
            curl_close($curl);
        }
        return $code_bitly;
    }
}
