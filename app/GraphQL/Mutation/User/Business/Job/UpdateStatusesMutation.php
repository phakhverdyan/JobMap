<?php

namespace App\GraphQL\Mutation\User\Business\Job;

use App\Business\Administrator;
use App\Business\Job;
use App\Business\JobCareerLevel;
use App\Business\JobCertificate;
use App\Business\JobDepartment;
use App\Business\JobLanguage;
use App\Business\JobLocation;
use App\Business\JobType;
use App\CareerLevel;
use App\Certificate;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\Jobs\JobAutoExpiredContinued;
use App\WorldLanguage;
use Carbon\Carbon;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            'open_locations' => [
                'type' => Type::string(),
                'description' => 'Open jobs to Assign locations'
            ],
            'close_locations' => [
                'type' => Type::string(),
                'description' => 'Open jobs to Assign locations'
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
            'jobs'
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();
        
        $where = ['job_id' => $args['id']];
        
        DB::beginTransaction();
        try {
            if (isset($args['open_locations']) && !empty($args['open_locations'])) {
                $locations = explode(',', $args['open_locations']);
                $jobtLocation = JobLocation::where($where);
                $jobtLocation->whereIn('location_id', $locations);
                $jobtLocation->update(['status' => 1, 'opened_at' => new \DateTime]);
                $job = Job::find($args['id']);
                $currentDT = Carbon::now()->timezone(0);
                if ($currentDT->diffInSeconds($job->created_at) > (Config::get('queue.day_job_expired')*24*60*60)) {
                    $job->created_at = $currentDT;
                    $dt = Carbon::create(date('Y'), date('m'), date('j'), date('H'), date('i'), date('s'));
                    $jobQueue = (new JobAutoExpiredContinued($job->id))->delay($dt->addDay(Config::get('queue.day_job_expired')));
                    //$jobQueue = (new JobAutoExpiredContinued($job->id))->delay($dt->addMinutes(1));
                    $jobQueueId = app(Dispatcher::class)->dispatch($jobQueue);
                    $job->job_id = $jobQueueId;
                    $job->save();
                    Log::info('--------------crete job------------------'.$jobQueueId.'---'.$job->id);
                }
            }
            
            if (isset($args['close_locations']) && !empty($args['close_locations'])) {
                $locations = explode(',', $args['close_locations']);
                $jobtLocation = JobLocation::where($where);
                $jobtLocation->whereIn('location_id', $locations);
                $jobtLocation->update(['status' => 0]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return null;
        }
        
        $data = Job::where([
            'id' => $args['id'],
            'business_id' => $args['business_id']
        ])->first();
        
        if (!$data) {
            return null;
        }

        if (JobLocation::where($where)->where('status', 1)->count() > 0) {
            if ($data->status == 0) {
                $data->status = 1;
                $data->save();
            }
        } else {
            if ($data->status == 1) {
                $data->status = 0;
                $data->save();
            }
        }

        $data['token'] = $this->token;
        
        return $data;
    }
}
