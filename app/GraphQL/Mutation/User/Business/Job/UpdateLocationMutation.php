<?php

namespace App\GraphQL\Mutation\User\Business\Job;

use App\Business;
use App\Business\Administrator;
use App\Business\Job;
use App\Business\JobCareerLevel;
use App\Business\JobCertificate;
use App\Business\JobDepartment;
use App\Business\JobLanguage;
use App\Business\JobLocation;
use App\Business\JobType;
use App\Business\Location;
use App\CareerLevel;
use App\Certificate;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\WorldLanguage;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;

class UpdateLocationMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Update Locations for Business Job'
    ];

    public function type()
    {
        return GraphQL::type('BusinessJob');
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
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Job id'
            ],
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Business id'
            ],
            'type' => [
                'type' => Type::int(),
                'description' => 'type assign/unassign all locations'
            ],
            'job_locations' => [
                'type' => Type::string(),
                'description' => 'Assign locations'
            ],
            'job_locations_detach' => [
                'type' => Type::string(),
                'description' => 'Assign locations'
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
            'jobs'
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();

        //$where = ['job_id' => $args['id']];

        //if (isset($args['job_locations']) && !empty($args['job_locations'])) {
            DB::beginTransaction();
            try {

                if (isset($args['type'])) {
                    switch ($args['type']) {
                        case 1:
                        case 3:
                            if ($args['type'] == 1) {
                                $businessIds = Business::where('parent_id', $args['business_id'])->select('id')->get()->pluck('id')->toArray();
                                $businessIds[] = $args['business_id'];
                                $locationIds = Location::whereIn('business_id', $businessIds)->select('id')->get()->pluck('id')->toArray();
                            } else {
                                $locationIds = Location::where('business_id', $args['business_id'])->select('id')->get()->pluck('id')->toArray();
                            }
                            JobLocation::where('job_id', $args['id'])->whereIn('location_id', $locationIds)->delete();
                            $dataInsert = [];
                            $jobStatus = null;
                            if ($job = Job::where(['id' => $args['id']])->first()) {
                                $jobStatus = $job->status;
                            };
                            foreach ($locationIds as $locationId) {
                                $dataInsert[] = array(
                                    'job_id' => $args['id'],
                                    'location_id' => $locationId,
                                    'status' => $jobStatus
                                );
                            }
                            $jobLocation = new JobLocation();
                            $jobLocation->insert($dataInsert);
                            break;
                        case 2:
                            JobLocation::where('job_id', $args['id'])->delete();
                            break;
                        case 4:
                            $locationIds = Location::where('business_id', $args['business_id'])->select('id')->get()->pluck('id')->toArray();
                            JobLocation::where('job_id', $args['id'])->whereIn('location_id', $locationIds)->delete();
                            break;
                    }
                } else {
                    if (isset($args['job_locations_detach']) && !empty($args['job_locations_detach'])) {
                        JobLocation::where('job_id', $args['id'])->whereIn('location_id', explode(',', $args['job_locations_detach']))->delete();
                    }
                    if (isset($args['job_locations']) && empty($args['job_locations'])) {
                        JobLocation::where('job_id', $args['id'])->delete();
                    }

                    if (isset($args['job_locations']) && !empty($args['job_locations'])) {
                        $locations = explode(',', $args['job_locations']);
                        $locationsExistAssigned = JobLocation::whereIn('location_id', $locations)->where('job_id', $args['id'])->distinct()->get();
                        // JobLocation::where('job_id', $args['id'])->delete();
                        $locationsExist = $locationsExistAssigned->pluck('location_id')->toArray();

                        $dataInsert = [];
                        $jobStatus = null;
                        if ($job = Job::where(['id' => $args['id']])->first()) {
                            $jobStatus = $job->status;
                        };

                        foreach ($locations as $location) {
                            if (!in_array($location, $locationsExist)) {
                                $dataInsert[] = array(
                                    'job_id' => $args['id'],
                                    'location_id' => $location,
                                    'status' => $jobStatus
                                );
                            }
                        }
                        $jobLocations = new JobLocation();
                        $jobLocations->insert($dataInsert);
                    }
                }
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                return null;
            }
       /* } else {
            JobLocation::where($where)->delete();

            $loc = Location::query()->where([
                'business_id' => $args['business_id'],
                'main' => 1
            ])->first();
            if($loc){
                $dataInsert[] = array(
                    'job_id' => $args['id'],
                    'location_id' => $loc['id']
                );
                $jobLocation = new JobLocation();
                $jobLocation->insert($dataInsert);
            }
        }*/

        $data = Job::where([
            'id' => $args['id'],
            'business_id' => $args['business_id']
        ])->first();

        if (!$data) {
            return null;
        }
        $data['token'] = $this->token;

        return $data;
    }
}
