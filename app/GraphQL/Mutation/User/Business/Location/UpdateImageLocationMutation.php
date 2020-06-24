<?php

namespace App\GraphQL\Mutation\User\Business\Location;

use App\Business\Administrator;
use App\Business\Location;
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

class UpdateImageLocationMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'updateImageLocation'
    ];
    
    public function type()
    {
        return GraphQL::type('UpdateImageLocation');
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
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Business id'
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
        //set authorized roles
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::FRANCHISE_ROLE,
        ];
        //set permissions for this object
        $this->permissions = [
            'locations'
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();
        $update = [];
        $errorMessage = '';

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
                            $ext = $inputImage->getClientOriginalExtension();
                            $fileName = md5('location-picture-' . $args['id']);
                            $storage = 'business/' . $args['business_id'] . '/logo/';
                            $originalImage = $fileName . '.png';
                            //save original image
                            // $inputImage->storeAs($storage, $originalImage);
                            Storage::makeDirectory($storage, 0775, true, true);
                            $image = Image::make($inputImage->getRealPath())->orientate()->encode('png');
                            $image->save(Storage::path($storage . $originalImage));

                            //create image crop by user crop area
                            $cropImage = Image::make($inputImage->getRealPath())->orientate()->encode('png');
                            $cropImage->crop((int)$imageCropData->width, (int)$imageCropData->height, (int)$imageCropData->x, (int)$imageCropData->y)->trim('black', array('top', 'bottom', 'left', 'right'));
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
                    $location = Location::where('id', $args['id'])->first();
                    $storage = 'business/' . $args['business_id'] . '/logo/';
                    $fileInfo = pathinfo($storage . $location['picture']);
                    $ext = $fileInfo['extension'];
                    $fileName = $fileInfo['filename'];
                    $originalImage = $fileName . '.' . $ext;
                    
                    //create image crop by user crop area
                    $cropImage = Image::make(Storage::get($storage . $originalImage))->orientate();
                    $cropImage->crop((int)$imageCropData->width, (int)$imageCropData->height, (int)$imageCropData->x, (int)$imageCropData->y)->trim('black', array('top', 'bottom', 'left', 'right'));
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
                $data = Location::where([
                    'id' => $args['id']
                ])->update($update);
                $update['id'] = $args['id'];
                $update['business_id'] = $args['business_id'];
            }

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
