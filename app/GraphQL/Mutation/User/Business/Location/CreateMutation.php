<?php

namespace App\GraphQL\Mutation\User\Business\Location;

use App\Business\Administrator;
use App\Business\JobLocation;
use App\Business\Location;
use App\Business\LocationAmenity;
use App\Business\DepartmentLocation;
use App\Business\ManagerLocation;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\Rules\{CheckValidGeo, CheckUniqueStreet};
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Contracts\Services\User\Business\Location as LocationContract;

class CreateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'New Business Location'
    ];

    /**
     * Business location service
     */
    private $locationService;

    /**
     * Create a new Mutation instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->locationService = app()->make(LocationContract::class);
    }

    public function type()
    {
        return GraphQL::type('BusinessLocation');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        // Get request params for street dublicate validation
        list($businessID, $locationID, $latitude, $longitude) = $this->locationService->getStreetValidationArgs(func_get_args());

        return [
            'name' => ['required_without:name_fr', 'string'],
            'name_fr' => ['required_without:name', 'string'],
            'street' => ['required', 'string', new CheckValidGeo(), new CheckUniqueStreet($businessID, $locationID, $latitude, $longitude)],
            'street_number' => ['required', 'string'],
            'city' => ['required', 'string', new CheckValidGeo()],
            'phone' => ['string']
        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Business id'
            ],
            'brand_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Brand id'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Location Name'
            ],
            'name_fr' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Location Name FR'
            ],
            'main' => [
                'type' => Type::int(),
                'description' => 'Main Location'
            ],
            'street' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Location Street'
            ],
            'street_number' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Location Street'
            ],
            'latitude' => [
                'type' => Type::float(),
                'description' => 'Location Latitude'
            ],
            'longitude' => [
                'type' => Type::float(),
                'description' => 'Location Longitude'
            ],
            'suite' => [
                'type' => Type::string(),
                'description' => 'Location Suite'
            ],
            'city' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Business location city'
            ],
            'region' => [
                'type' => Type::string(),
                'description' => 'Business location region'
            ],
            'country' => [
                'type' => Type::string(),
                'description' => 'Business location country'
            ],
            'country_code' => [
                'type' => Type::string(),
                'description' => 'Business location country code'
            ],
            'phone_country_code' => [
                'type' => Type::string(),
                'description' => 'Business location phone country code'
            ],
            'phone_code' => [
                'type' => Type::string(),
                'description' => 'Business location phone code'
            ],
            'phone' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Business location phone'
            ],
            'zip_code' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Business location zip_code'
            ],
            'type' => [
                'type' => Type::string(),
                'description' => 'Location type'
            ],
            'amenities' => [
                'type' => Type::string(),
                'description' => 'Location amenities'
            ],
            'department_locations' => [
                'type' => Type::string(),
                'description' => 'Assign departments'
            ],
            'manager_locations' => [
                'type' => Type::string(),
                'description' => 'Assign managers'
            ],
            'managers_type' => [
                'type' => Type::string(),
                'description' => 'Location manager type'
            ],
            'job_locations' => [
                'type' => Type::string(),
                'description' => 'Assign jobs'
            ],
            'logo' => [
                'type' => Type::string(),
                'description' => 'logo'
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
            //Administrator::BRANCH_ROLE,
        ];
        //set permissions for this object
        $this->permissions = [
            'locations'
        ];
        //set business ID
        $this->businessID = $args['brand_id'];
        //check permissions
        $this->check();

        DB::beginTransaction();

        try {
            if ($args['brand_id']) {
                $args['business_id'] = $args['brand_id'];
            }
            if(isset($args['main']) && $args['main'] == 1){
                Location::where([
                    'business_id' => $args['business_id']
                ])->update([
                    'main' => 0
                ]);
            }

            $data = new Location();
            foreach ($args as $k => $v) {
                if ($k != 'brand_id' && $k !== 'logo' && $k !== 'amenities' && $k !== 'department_locations' && $k !== 'manager_locations' && $k !== 'job_locations')
                    $data->{$k} = trim($v);
            }

            // Save FR version if EN is empty
            if (isset($args['name_fr']) && empty($args['name'])) {
                $data->name = $args['name_fr'];
            }

            $data->user_id = $this->auth->id;
            $data->save();

            if (!empty($args['amenities'])) {
                $locationAmenity = new LocationAmenity();
                $amenities = explode(',', $args['amenities']);
                $dataInsert = [];
                foreach ($amenities as $amenity) {
                    $dataInsert[] = array(
                        'location_id' => $data['id'],
                        'amenity_id' => $amenity
                    );
                }
                $locationAmenity->insert($dataInsert);
            }

            if (isset($args['department_locations']) && !empty($args['department_locations'])) {
                $departmentLocation = new DepartmentLocation();
                $departments = explode(',', $args['department_locations']);
                $dataInsert = [];
                foreach ($departments as $department) {
                    $dataInsert[] = array(
                        'location_id' => $data['id'],
                        'department_id' => $department
                    );
                }
                $departmentLocation->insert($dataInsert);
            }

            if (isset($args['manager_locations']) && !empty($args['manager_locations'])) {
                $locationManagerType = $data->managers_type;
                $managerLocation = new ManagerLocation();

                $managers = Administrator::whereIn('id', explode(',', $args['manager_locations']))->get();

                $dataInsert = [];
                foreach ($managers as $manager) {

                    if ($manager->role != $locationManagerType) {
                        continue;
                    }

                    $dataInsert[] = array(
                        'location_id' => $data['id'],
                        'administrator_id' => $manager->getKey()
                    );
                }
                $managerLocation->insert($dataInsert);
            }
            else {
                $managerLocation = new ManagerLocation();
                $manager = Administrator::where('user_id', $this->auth->id)->firstOrFail();
                $managerLocation->location_id = $data['id'];
                $managerLocation->administrator_id = $manager->id;
                $managerLocation->timestamps = false;
                $managerLocation->save();
            }

            if (isset($args['job_locations']) && !empty($args['job_locations'])) {
                $jobLocation = new JobLocation();
                $job_location_ids = explode(',', $args['job_locations']);
                $dataInsert = [];
                foreach ($job_location_ids as $job_location_id) {
                    $dataInsert[] = array(
                        'location_id' => $data['id'],
                        'job_id' => $job_location_id
                    );
                }
                $jobLocation->insert($dataInsert);
            }

            //save picture if exist
            if (Input::hasFile('avatar_file')) {
                if (Input::file('avatar_file')->isValid()) {
                    try {
                        ini_set('memory_limit', '-1');
                        $imageCropData = \GuzzleHttp\json_decode(Input::get('avatar_data'));
                        $inputImage = Input::file('avatar_file');
                        if ($inputImage->getClientSize() < 24500000) {
                            $ext = $inputImage->getClientOriginalExtension();
                            $fileName = md5('location-picture-' . $data->id);
                            $storage = 'business/' . $data->business_id . '/logo/';
                            $originalImage = $fileName . '.png';
                            //save original image

                            Storage::makeDirectory($storage, 0775, true, true);
                            $image = Image::make($inputImage->getRealPath())->orientate()->encode('png');
                            $image->save(Storage::path($storage . $originalImage));

                            //create image crop by user crop area
                            $cropImage = Image::make($inputImage->getRealPath())->orientate()->encode('png');
                            $cropImage->crop((int)$imageCropData->width, (int)$imageCropData->height, (int)$imageCropData->x, (int)$imageCropData->y);
                            $encode = $cropImage->encode();
                            Storage::put($storage . 'crop_' . $originalImage, $encode);
                            //create thumbnail 200x200
                            $cropImage->resize(200, 200);
                            Storage::put($storage . '200.200.' . $originalImage, $encode);
                            //create thumbnail 100x100
                            $cropImage->resize(100, 100);
                            Storage::put($storage . '100.100.' . $originalImage, $encode);
                            //create thumbnail 50x50
                            $cropImage->resize(50, 50);
                            Storage::put($storage . '50.50.' . $originalImage, $encode);

                            Location::where([
                                'id' => $data->id
                            ])->update([
                                'picture' => $originalImage
                            ]);
                        } else {
                            $errorMessage = $inputImage->getClientSize() . 'byte';
                        }

                    } catch (Exception $e) {

                    }
                }
            } elseif (isset($args['logo']) && $args['logo']) {
                Location::where([
                    'id' => $data->id
                ])->update([
                    'picture' => $args['logo']
                ]);
            }


            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return null;
        }

        if (!$data) {
            return null;
        }

        $data['token'] = $this->token;
        $data['amenities'] = $args['amenities'];

        return $data;
    }
}
