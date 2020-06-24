<?php

namespace App\GraphQL\Mutation\User\Business\Job;

use App\Business\Administrator;
use App\Business\Job;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\JobQueue;
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
        'name' => 'Delete Business Job'
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
                'description' => 'Job id'
            ],
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Business id'
            ],
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
        
        $job = Job::where([
            'id' => $args['id'],
            'business_id' => $args['business_id']
        ])->first();

        if ($job){
            $jobQueue = JobQueue::find($job->job_id);

            if (!$job->delete()) {
                return null;
            }

            if ($jobQueue) {
                $jobQueue->delete();
            }
        }
        
        $data = [];
        $data['token'] = $this->token;    
        return $data;
    }
}
