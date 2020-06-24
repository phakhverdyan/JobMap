<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Business;
use App\Business\Administrator;
use App\Business\Department;
use App\Business\Job;
use App\Business\Location;
use App\Business\BusinessBillingInvoice;
use App\Candidate\Candidate;
use App\GraphQL\Extensions\AuthQuery;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class NotifyCounterQuery extends AuthQuery
{
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'NotifyCounter Business'
    ];

    public function type()
    {
        return GraphQL::type('NotifyCounterBusiness');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the business'
            ]
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args)
    {
        $UserManager = Administrator::where('user_id', auth()->user()->id)->where("business_id",  $args['business_id'])->first();
        $Business_ids = Business::query()->Where('id', $args['business_id'])->orWhere('parent_id', $args['business_id'])->get()->pluck("id")->toArray();

        $query = Candidate::query()->join('users', 'users.id', '=', 'c.user_id');
        $query->whereIn('c.business_id', $Business_ids);

        $query->select([
            'c.user_id as user_id',
            'c.id as id',
            'c.*',
        ])->distinct();

        $query->from(DB::raw('candidates c'));
        $data = clone $query;
        $countApplicantsTotal = $data->distinct()->count('c.user_id');


        $applicants = Candidate::query();
        $applicants->select('c.id','pipeline')->whereIn('business_id', $Business_ids);

        if(!empty($UserManager) && $UserManager->role != Administrator::ADMIN_ROLE){
            $applicants = $applicants->join("business_manager_locations", "business_manager_locations.location_id", "=", "c.location_id")
                ->where("business_manager_locations.administrator_id", $UserManager['id']);
        }

        $applicants->from(DB::raw('candidates c'));

        // last candidate request id will be seelcted by MAX(id)
        // correlated subquery 

        $sub_query = '(SELECT max(candidates.id) FROM candidates WHERE user_id = c.user_id and business_id = ' .  $args['business_id'] . ')';
        $applicants->having('c.id', '=', DB::raw($sub_query));

        $countApplicantsNew = $applicants->where('pipeline', "new")->get()->count();

        $countManagers = Administrator::has('user')->where('business_id', $args['business_id'])->count();

        $countLocations = Business\Location::whereIn('business_id', $Business_ids);
        if(!empty($UserManager) && $UserManager->role != Administrator::ADMIN_ROLE){
            $countLocations = $countLocations->join("business_manager_locations", "business_manager_locations.location_id", "=", "business_locations.id")
                ->where("business_manager_locations.administrator_id", $UserManager['id']);
        }
        $countLocations = $countLocations->count();

        $Jobs = Job::whereIn('business_id', $Business_ids);
        if(!empty($UserManager) && $UserManager->role != Administrator::ADMIN_ROLE){
            $Jobs = $Jobs->join('business_job_locations', 'business_job_locations.job_id', '=', 'business_jobs.id');
            $Jobs = $Jobs->join("business_manager_locations", "business_manager_locations.location_id", "=", "business_job_locations.location_id")
                ->where("business_manager_locations.administrator_id", $UserManager['id']);
        }

        $countJobs = $Jobs->distinct('business_jobs.id')->count('business_jobs.id');
        
        $countBrands = 0;
        if(!empty($UserManager) && $UserManager->role == Administrator::MANAGER_ROLE){

            $countBrands = Business::select(['businesses.*'])
                ->where('businesses.id', $args['business_id'])
                ->orWhere('businesses.parent_id', $args['business_id'])
                ->where("business_manager_locations.administrator_id", $UserManager['id'])
                ->join("business_locations", "business_locations.business_id", "=", "businesses.id")
                ->join("business_manager_locations", "business_manager_locations.location_id", "=", "business_locations.id")
                ->get()->all();

            foreach ($countBrands as $business) {
                if (!$business->parent_id) {
                    array_unshift($countBrands, $business);
                }
            }

            $countBrands = array_unique($countBrands);
            $countBrands = count($countBrands);

        }elseif(!empty($UserManager) && $UserManager->role != Administrator::FRANCHISE_ROLE){
            $countBrands = Business::where('parent_id', $args['business_id'])->count();
        }
        $result = array(
            'applicants_total' => $countApplicantsTotal,
            'applicants_new' => $countApplicantsNew,
            'managers' => $countManagers,
            'locations' => $countLocations,
            //'departments' => $countDepartments,
            'jobs' => $countJobs,
            'brands' => $countBrands,
            'token' => $this->token
        );

        if($UserManager->role == Administrator::ADMIN_ROLE) {
            $result['failed_invoices'] = BusinessBillingInvoice::where('user_paid_id', auth()->user()->id)
            ->where('paid','false')
            ->where('status', '!=','voided')
            ->count();
        }


        return $result;
    }
}
