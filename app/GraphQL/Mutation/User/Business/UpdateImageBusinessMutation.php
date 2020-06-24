<?php

namespace App\GraphQL\Mutation\User\Business;

use App\Business\Administrator;
use App\GraphQL\Auth;
use App\Business;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Mockery\Exception;

class UpdateImageBusinessMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'updateImageBusiness'
    ];

    public function type()
    {
        return GraphQL::type('UpdateImageBusiness');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'id' => ['required']
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
            'images_ids_sort' => [
                'type' => Type::listOf(Type::int()),
                'description' => 'sort ids of images'
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
        $errorMessage = null;

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

            $isAvatar = false;
            //save picture if exist
            if (Input::hasFile('avatar_file')) {
                if (Input::file('avatar_file')->isValid()) {
                    try {
                        ini_set('memory_limit', '-1');
                        $imageCropData = \GuzzleHttp\json_decode(Input::get('avatar_data'));
                        $inputImage = Input::file('avatar_file');
                        if ($inputImage->getClientSize() < 24500000) {
                            $fileName = md5('business-picture-' . $args['id']);
                            $storage = 'business/' . $args['id'] . '/logo/';
                            $originalImage = $fileName . '.png';


                            //save original image
                            // $inputImage->storeAs($storage, $originalImage);
                            Storage::makeDirectory($storage, 0775, true, true);

                            $image = Image::make($inputImage->getRealPath())->orientate()->encode('png');
                            $image->save(Storage::path($storage . $originalImage));

                            //create image crop by user crop area
                            $cropImage = Image::make($inputImage->getRealPath())->orientate()->encode('png');
                            $cropImageBackground = Image::canvas((int) $imageCropData->width, (int) $imageCropData->height);
                            $cropImageBackground->encode('png');
                            $cropImageBackground->insert($cropImage, 'top-left', -(int) $imageCropData->x, -(int) $imageCropData->y);
                            $cropImage = $cropImageBackground;

                            Storage::put($storage . 'crop_' . $originalImage, $cropImage->encode());
                            //create thumbnail 512x512
                            $cropImage->resize(512, 512, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            });
                            Storage::put($storage . '512.512.' . $originalImage, $cropImage->encode());
                            //create thumbnail 256x256
                            $cropImage->resize(256, 256, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            });
                            Storage::put($storage . '256.256.' . $originalImage, $cropImage->encode());
                            //create thumbnail 200x200
                            $cropImage->resize(200, 200, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            });
                            Storage::put($storage . '200.200.' . $originalImage, $cropImage->encode());
                            //create thumbnail 100x100
                            $cropImage->resize(100, 100, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            });
                            Storage::put($storage . '100.100.' . $originalImage, $cropImage->encode());
                            //create thumbnail 50x50
                            $cropImage->resize(50, 50, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            });
                            Storage::put($storage . '50.50.' . $originalImage, $cropImage->encode());

                            $update['picture'] = $originalImage;
                        } else {
                            $update['picture'] = '';
                            $errorMessage = $inputImage->getClientSize() . 'byte';
                        }

                    } catch (Exception $e) {

                    }
                }
                $isAvatar = true;
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
                    $cropImage = Image::make(Storage::get($storage . $originalImage))->orientate()->encode('png');
                    $cropImageBackground = Image::canvas((int) $imageCropData->width, (int) $imageCropData->height);
                    $cropImageBackground->encode('png');
                    $cropImageBackground->insert($cropImage, 'top-left', -(int) $imageCropData->x, -(int) $imageCropData->y);
                    $cropImage = $cropImageBackground;
                    
                    Storage::put($storage . 'crop_' . $originalImage, $cropImage->encode());
                    //create thumbnail 512x512
                    $cropImage->resize(512, 512, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    Storage::put($storage . '512.512.' . $originalImage, $cropImage->encode());
                    //create thumbnail 256x256
                    $cropImage->resize(256, 256, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    Storage::put($storage . '256.256.' . $originalImage, $cropImage->encode());
                    //create thumbnail 200x200
                    $cropImage->resize(200, 200, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    Storage::put($storage . '200.200.' . $originalImage, $cropImage->encode());
                    //create thumbnail 100x100
                    $cropImage->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    Storage::put($storage . '100.100.' . $originalImage, $cropImage->encode());
                    //create thumbnail 50x50
                    $cropImage->resize(50, 50, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    Storage::put($storage . '50.50.' . $originalImage, $cropImage->encode());

                    $update['picture'] = $originalImage;
                } catch (Exception $e) {

                }
                $isAvatar = true;
            }
            if ($isAvatar) {
                $data = Business::where([
                    'id' => $args['id']
                ])->update($update);
                $update['id'] = $args['id'];
            }

            $isBG = false;
            //save bg_picture if exist
            if (Input::hasFile('business_bg_file')) {
                if (Input::file('business_bg_file')->isValid()) {
                    try {
                        ini_set('memory_limit', '-1');
                        $imageCropData = \GuzzleHttp\json_decode(Input::get('business_bg_data'));
                        $inputImage = Input::file('business_bg_file');
                        if ($inputImage->getClientSize() < 24500000) {
                            $ext = $inputImage->getClientOriginalExtension();
                            $fileName = md5('business-bg-picture-' . $args['id'] . time());
                            $storage = 'business/' . $args['id'] . '/logo/';
                            $originalImage = $fileName . '.' . $ext;
                            //save original image
                            $inputImage->storeAs($storage, $originalImage);

                            //create image crop by user crop area
                            $cropImage = Image::make($inputImage->getRealPath())->orientate();
                            $cropImage->crop((int)$imageCropData->width, (int)$imageCropData->height, (int)$imageCropData->x, (int)$imageCropData->y)->trim('black', array('top', 'bottom', 'left', 'right'));
                            Storage::put($storage . 'crop_' . $originalImage, $cropImage->encode());

                            $update['bg_picture'] = $originalImage;
                        } else {
                            $update['bg_picture'] = '';
                            $errorMessage = $inputImage->getClientSize() . 'byte';
                        }

                    } catch (Exception $e) {

                    }
                }
                $isBG = true;
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
                    $cropImage->crop((int)$imageCropData->width, (int)$imageCropData->height, (int)$imageCropData->x, (int)$imageCropData->y)->trim('black', array('top', 'bottom', 'left', 'right'));
                    Storage::put($storage . 'crop_' . $originalImage, $cropImage->encode());

                    $update['bg_picture'] = $originalImage;
                } catch (Exception $e) {

                }
                $isBG = true;
            }

            if ($isBG) {
                $bus = Business::with('images')->find($args['id']);
                $update['number'] = count($bus->images) +1;
                $update = $bus->images()->create($update);
            }
            /*$data = Business::where([
                'id' => $args['id']
            ])->update($update);*/

            if (isset($args['images_ids_sort'])) {
                foreach ($args['images_ids_sort'] as $key => $id) {
                    $result = Business\Image::whereId($id)->update(['number' => $key+1]);
                }
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return null;
        }

        if (strlen($errorMessage) > 0) {
            $update['error_message'] = $errorMessage;
        }

        //$update['id'] = $args['id'];
        $update['token'] = $this->token;

        return $update;
    }
}
