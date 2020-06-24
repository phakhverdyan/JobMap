<?php

namespace App\GraphQL\Mutation\User\Business;

use App\Business\Administrator;
use App\Business\Location;
use App\GraphQL\Auth;
use App\Business;
use App\GraphQL\AuthBusiness;
use App\Keyword;
use App\Rules\CheckValidGeo;
use Folklore\GraphQL\Error\ValidationError;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UpdateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Update Business'
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
            'id' => ['required'],
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
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the business'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of business'
            ],
            'name_fr' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The FR name of business'
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The description of business'
            ],
            'description_fr' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The FR description of business'
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
            // 'direct_link' => [
            //     'type' => Type::string(),
            //     'description' => 'The direct link of business'
            // ],
            // 'direct_link_fr' => [
            //     'type' => Type::string(),
            //     'description' => 'The direct link of business FR'
            // ],
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
            // 'languages' => [
            //     'type' => Type::string(),
            //     'description' => 'Business Languages'
            // ],
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
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args)
    {
        if (Business::find($args['id']) && Business::find($args['id'])->parent_id) {
            //set authorized roles
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
            $this->businessID = $args['id'];
            //check permissions
            $this->check();
        }

        DB::beginTransaction();

        try {
            Business\Keyword::where([
                'business_id' => $args['id']
            ])->delete();

            // Business\Language::where([
            //     'business_id' => $args['id']
            // ])->delete();

            $update = [];

//            if (isset($args['sub_industry_id'])) {
//                if ($args['sub_industry_id'] == 0) {
//                    $update['sub_industry_id'] = null;
//                }
//                else {
//                    $update['sub_industry_id'] = $args['sub_industry_id'];
//                }
//            }

            $excluded_fields_from_update = [
                'id',
                'industries',
                'sub_industry_id',
                // 'keywords',
                // 'keywords_fr',
                'language_prefix',
            ];

            foreach ($args as $argument_name => $argument_value) {
                if (!in_array($argument_name, $excluded_fields_from_update)) {
                    $update[$argument_name] = $argument_value;
                }
            }

            if (isset($args['name'])) {
                $update['slug'] = str_slug($args['name']);
            } else {
                $update['slug'] = str_slug($args['name_fr']);
            }

            if ($language = \App\Language::where('prefix', $args['language_prefix'])->first()) {
                $update['language_prefix'] = $language->prefix;
            }
            else {
                $update['language_prefix'] = null;
            }

            // $languages = [
            //     [
            //         'business_id' => $args['id'],
            //         'language_id' => $args['language'],
            //         'status' => 1
            //     ]
            // ];

            // if (isset($args['languages']) && !empty($args['languages'])) {
            //     $langs = explode(',', $args['languages']);
            //     foreach ($langs as $lang){
            //         if($lang != $args['language']) {
            //             $languages[] = [
            //                 'business_id' => $args['id'],
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
            //                 'business_id' => $args['id'],
            //                 'keyword_id' => $keyword->id,
            //             ];
            //         }

            //         $business_keywords->insert($business_keywords_data_to_insert);
            //     }
            // }

            //save picture if exist
            /*if (Input::hasFile('avatar_file')) {
                if (Input::file('avatar_file')->isValid()) {
                    try {
                        ini_set('memory_limit', '-1');
                        $imageCropData = \GuzzleHttp\json_decode(Input::get('avatar_data'));
                        $inputImage = Input::file('avatar_file');
                        $ext = $inputImage->getClientOriginalExtension();
                        $fileName = md5('business-picture-' . $args['id']);
                        $storage = 'business/' . $args['id'] . '/logo/';
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

                        $update['picture'] = $originalImage;
                    } catch (Exception $e) {

                    }
                }
            } else if (Input::get('avatar_data')) {
                try {
                    ini_set('memory_limit', '-1');

                    $imageCropData = \GuzzleHttp\json_decode(Input::get('avatar_data'));
                    $business = Business::where('id', $args['id'])->first();
                    $storage = 'business/' . $args['id'] . '/logo/';
                    $fileInfo = pathinfo($storage . $business['picture']);
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

                    $update['picture'] = $originalImage;
                } catch (Exception $e) {

                }
            }

            //save bg_picture if exist
            if (Input::hasFile('business_bg_file')) {
                if (Input::file('business_bg_file')->isValid()) {
                    try {
                        ini_set('memory_limit', '-1');
                        $imageCropData = \GuzzleHttp\json_decode(Input::get('business_bg_data'));
                        $inputImage = Input::file('business_bg_file');
                        $ext = $inputImage->getClientOriginalExtension();
                        $fileName = md5('business-bg-picture-' . $args['id']);
                        $storage = 'business/' . $args['id'] . '/logo/';
                        $originalImage = $fileName . '.' . $ext;
                        //save original image
                        $inputImage->storeAs($storage, $originalImage);

                        //create image crop by user crop area
                        $cropImage = Image::make($inputImage->getRealPath())->orientate();
                        $cropImage->crop((int)$imageCropData->width, (int)$imageCropData->height, (int)$imageCropData->x, (int)$imageCropData->y);
                        Storage::put($storage . 'crop_' . $originalImage, $cropImage->encode());

                        $update['bg_picture'] = $originalImage;
                    } catch (Exception $e) {

                    }
                }
            } else if (Input::get('business_bg_data')) {
                try {
                    ini_set('memory_limit', '-1');

                    $imageCropData = \GuzzleHttp\json_decode(Input::get('business_bg_data'));
                    $business = Business::where('id', $args['id'])->first();
                    $storage = 'business/' . $args['id'] . '/logo/';
                    $fileInfo = pathinfo($storage . $business['bg_picture']);
                    $ext = $fileInfo['extension'];
                    $fileName = $fileInfo['filename'];
                    $originalImage = $fileName . '.' . $ext;

                    //create image crop by user crop area
                    $cropImage = Image::make(Storage::get($storage . $originalImage))->orientate();
                    $cropImage->crop((int)$imageCropData->width, (int)$imageCropData->height, (int)$imageCropData->x, (int)$imageCropData->y);
                    Storage::put($storage . 'crop_' . $originalImage, $cropImage->encode());

                    $update['bg_picture'] = $originalImage;
                } catch (Exception $e) {

                }
            }*/

            $data = Business::where([
                'id' => $args['id']
            ])->update($update);

            $business = Business::find($args['id']);
            $business->industries()->sync(explode(",", $args['industries']));

            $updateLocation = [];
            if(isset($args['city'])) {
                $updateLocation['city'] = $update['city'];
                $updateLocation['latitude'] = $update['latitude'];
                $updateLocation['longitude'] = $update['longitude'];
            }
            if(isset($args['region'])) {
                $updateLocation['region'] = $update['region'];
            }
            if(isset($args['country'])) {
                $updateLocation['country'] = $update['country'];
            }
            if(isset($args['country_code'])) {
                $updateLocation['country_code'] = $update['country_code'];
            }
            if(isset($args['street'])) {
                $updateLocation['street'] = $update['street'];
            }
            if(isset($args['street_number'])) {
                $updateLocation['street_number'] = $update['street_number'];
            }
            if (count($updateLocation)) {
                Location::where([
                    'business_id' => $args['id'],
                    'main' => 1
                ])->update($updateLocation);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return null;
        }


        if (!$data) {
            return null;
        }

        return ['token' => $this->token];
    }
}
