<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Candidate\Candidate;
use App\GraphQL\Extensions\AuthQuery;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;

class GetDaysFromSendResumeQuery extends AuthQuery
{
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'getDaysFromSendResume'
    ];
    
    public function type()
    {
        return GraphQL::type('GetDaysFromSendResume');
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
            ],
            'location_id' => [
                'type' => Type::id(),
                'description' => 'The id of the location'
            ],
            'job_id' => [
                'type' => Type::id(),
                'description' => 'The id of the job'
            ],
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args)
    {
        $where = [
            'business_id' => $args['business_id'],
            'user_id' => $this->auth->id,
            'location_id' => null,
            'job_id' => null
        ];
        if (isset($args['location_id'])) {
            $where['location_id'] = $args['location_id'];
        }
        if (isset($args['job_id'])) {
            $where['job_id'] = $args['job_id'];
        }

        $days = 0;
        if ($candidate = Candidate::where($where)->first()) {
            $now = time();
            $date = date('Y-m-d H:i:s', strtotime('-' . config('services.send_resume_interval') . ' day', $now));
            if ($candidate['updated_at'] < $date) {
                $days = 0;
            } else {
                $your_date = strtotime($candidate['updated_at']);
                $datediff = $now - $your_date;
                $days = config('services.send_resume_interval') - round($datediff / (60 * 60 * 24));
            }
        }

        $data['days'] = $days;
        $data['token'] = $this->token;
        
        return $data;
    }
}
