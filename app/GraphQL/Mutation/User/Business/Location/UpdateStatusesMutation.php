<?php

namespace App\GraphQL\Mutation\User\Business\Location;

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

class UpdateStatusesMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'Update status for Business Job'
    ];
    
    public function type()
    {
        return GraphQL::type('BusinessLocation');
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
                'description' => 'Location id'
            ],
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Business id'
            ],
            'open_jobs' => [
                'type' => Type::string(),
                'description' => 'Open jobs to location'
            ],
            'close_jobs' => [
                'type' => Type::string(),
                'description' => 'Open jobs to location'
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
            Administrator::BRANCH_ROLE
        ];
        //set permissions for this object
        $this->permissions = [
            'locations'
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();
        
        $where = ['location_id' => $args['id']];
        
        DB::beginTransaction();
        try {
            if (isset($args['open_jobs']) && !empty($args['open_jobs'])) {
                $jobs = explode(',', $args['open_jobs']);
                $jobtLocation = JobLocation::where($where);
                $jobtLocation->whereIn('job_id', $jobs);
                $jobtLocation->update(['status' => 1, 'google_jobs_notified' => 0]);
            }
            
            if (isset($args['close_jobs']) && !empty($args['close_jobs'])) {
                $jobs = explode(',', $args['close_jobs']);
                $jobtLocation = JobLocation::where($where);
                $jobtLocation->whereIn('job_id', $jobs);
                $jobtLocation->update(['status' => 0, 'google_jobs_notified' => 0]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return null;
        }
        
        $data = Location::where([
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
