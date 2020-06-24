<?php

namespace App\GraphQL\Mutation\User\Business\Location;

use App\Business\Administrator;
use App\Business\JobLocation;
use App\Business\Location;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class DeleteMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'Delete Business Location'
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
        return [];
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
        
        $count = Location::where([
            'business_id' => $args['business_id']
        ])->count();
        
        if ($count > 1) {
            $location = Location::where([
                'id' => $args['id'],
                'business_id' => $args['business_id']
            ]);
            
            if ($location) {
                $loc = clone $location;
                $l = $loc->first();
    
                $jobs = $l['jobs'];
                
                if (!$location->delete()) {
                    return null;
                } else {
                    if ($l['main'] == 1) {
                        Location::where([
                            'business_id' => $args['business_id'],
                        ])->limit(1)->update([
                            'main' => 1
                        ]);
                    }
                    
                    $mainLoc = Location::query()->where([
                        'business_id' => $args['business_id'],
                        'main' => 1
                    ])->first();
    
                    foreach ($jobs as $job) {
                        $oldJobLoc = JobLocation::query()->where([
                            'job_id' => $job['job']['id']
                        ])->get()->all();
                        if (!$oldJobLoc) {
                            $jobLoc = new JobLocation();
                            $jobLoc->job_id = $job['job']['id'];
                            $jobLoc->location_id = $mainLoc['id'];
                            $jobLoc->status = $job['job']['status'];
                            $jobLoc->google_jobs_notified = 0;
                            $jobLoc->save();
                        }
                    }
                }
            }
        }
        
        $data['token'] = $this->token;
        
        return $data;
    }
}
