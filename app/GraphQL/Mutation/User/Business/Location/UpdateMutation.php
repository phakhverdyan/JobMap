<?php

namespace App\GraphQL\Mutation\User\Business\Location;

use App\Business;
use App\Business\Administrator;
use App\Business\Job;
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
use App\Contracts\Services\User\Business\Location as LocationContract;

class UpdateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Update Business Location'
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
            'name'          => ['required_without:name_fr', 'string'],
            'name_fr'       => ['required_without:name', 'string'],
            'street'        => ['required', 'string', new CheckValidGeo(), new CheckUniqueStreet($businessID, $locationID, $latitude, $longitude)],
            'street_number' => ['required', 'string'],
            'city'          => ['required', 'string', new CheckValidGeo()],
            'phone'         => ['string']
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
                'description' => 'Location id'
            ],
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
                'description' => 'Location managers type'
            ],
            'job_locations' => [
                'type' => Type::string(),
                'description' => 'Assign managers'
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
        ];
        //set permissions for this object
        $this->permissions = [
            'locations'
        ];
        //set business ID
        $this->businessID = $args['brand_id'];
        //check permissions
        $this->check();

        $update = [];
        foreach ($args as $field => $value) {
            if ($field != 'brand_id' && $field !== 'logo' && $field != 'id' && $field != 'amenities' &&
                $field != 'department_locations' && $field != 'manager_locations' && $field != 'job_locations') {
                $update[$field] = trim($value);
            }
        }

        DB::beginTransaction();

        try {
            if (isset($args['logo']) && $args['logo'] && !Location::find($args['id'])->picture) {
                $update['picture' ]= $args['logo'];
            }

            if ($args['brand_id']) {
                $update['business_id'] = $args['brand_id'];
            }
            if(isset($args['main']) && $args['main'] == 1){
                Location::where([
                    'business_id' => $update['business_id']
                ])->update([
                    'main' => 0
                ]);
            }

            Location::where([
                'id' => $args['id'],
                'business_id' => $update['business_id']
            ])->update($update);


            $updateBusiness = [];
            if(isset($args['city'])) {
                $updateBusiness['city'] = $update['city'];
                $updateBusiness['latitude'] = $update['latitude'];
                $updateBusiness['longitude'] = $update['longitude'];
            }
            if(isset($args['region'])) {
                $updateBusiness['region'] = $update['region'];
            }
            if(isset($args['country'])) {
                $updateBusiness['country'] = $update['country'];
            }
            if(isset($args['country_code'])) {
                $updateBusiness['country_code'] = $update['country_code'];
            }
            if(isset($args['street'])) {
                $updateBusiness['street'] = $update['street'];
            }
            if(isset($args['street_number'])) {
                $updateBusiness['street_number'] = $update['street_number'];
            }
            if (count($updateBusiness) && $locat = Location::find($args['id'])) {
                if ($locat->main) {
                    Business::where('id', $update['business_id'])->update($updateBusiness);
                }
            }


            LocationAmenity::where('location_id', $args['id'])->delete();
            DepartmentLocation::where('location_id', $args['id'])->delete();
            //ManagerLocation::where('location_id', $args['id'])->delete();

            if (!empty($args['amenities'])) {
                $locationAmenity = new LocationAmenity();
                $amenities = explode(',', $args['amenities']);
                $dataInsert = [];
                foreach ($amenities as $amenity) {
                    $dataInsert[] = array(
                        'location_id' => $args['id'],
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
                        'location_id' => $args['id'],
                        'department_id' => $department
                    );
                }
                $departmentLocation->insert($dataInsert);
            }

            if (isset($args['manager_locations']) && !empty($args['manager_locations'])) {

                $locationManagerType = Location::findOrFail($args['id'])->managers_type;

                $managerLocation = new ManagerLocation();

                $managers = Administrator::whereIn('id', explode(',', $args['manager_locations']))->get();

                $dataInsert = [];
                foreach ($managers as $manager) {

                    if ($manager->role != $locationManagerType) {
                        continue;
                    }

                    $dataInsert[] = array(
                        'location_id' => $args['id'],
                        'administrator_id' => $manager->getKey()
                    );
                }
                $managerLocation->insert($dataInsert);
            }

            if (isset($args['job_locations']) && !empty($args['job_locations'])) {
                $jobs = explode(',', $args['job_locations']);
                JobLocation::where('location_id', $args['id'])->whereNotIn('job_id', $jobs)->delete();

                $dataInsert = [];
                foreach ($jobs as $job) {
                    $jobLocation = JobLocation::where([
                        'location_id' => $args['id'],
                        'job_id' => $job
                    ])->first();

                    if (!$jobLocation) {
                        $jobItem = Job::where(['id' => $job])->first();

                        $dataInsert[] = array(
                            'location_id' => $args['id'],
                            'job_id' => $job,
                            'status' => $jobItem['status'],
                            'google_jobs_notified' => 0,
                        );
                    }
                }
                $jobLocation = new JobLocation();
                $jobLocation->insert($dataInsert);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return null;
        }

        return ['token' => $this->token];
    }
}
