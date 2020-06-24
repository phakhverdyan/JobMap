<?php

namespace App\GraphQL\Query\User\Auth;

use App\Business\Administrator;
use App\Business\ManagerLocation;
use App\Candidate\Candidate;
use App\GraphQL\Extensions\AuthQuery;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;

class SentQuery extends AuthQuery
{
    protected $attributes = [
        'name' => 'Sent resume'
    ];
    
    public function type()
    {
        return GraphQL::type('SentResumes');
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'keywords' => [
                'type' => Type::string(),
                'description' => 'Search candidates by keywords'
            ],
            'sort' => [
                'type' => Type::string(),
                'description' => 'Set field for order'
            ],
            'order' => [
                'type' => Type::string(),
                'description' => 'Set order'
            ],
            'limit' => [
                'type' => Type::int(),
                'description' => 'Set limit items'
            ],
            'status' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Status sent resume'
            ],
            'page' => [
                'type' => Type::int(),
                'description' => 'Set current page'
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
        $query = Candidate::query()
            ->join('users', 'users.id', '=', 'c.user_id')
            ->join('businesses', 'businesses.id', '=', 'c.business_id')
            ->leftJoin('candidate_resume_requests', function ($query) {
                $query->on('candidate_resume_requests.business_id', '=', 'c.business_id');
                $query->on('candidate_resume_requests.user_id', '=', 'c.user_id');
                $query->where('candidate_resume_requests.request', 1);
                $query->where('candidate_resume_requests.response', 0);
            });
        
        if (isset($args['keywords'])) {
            $value = $args['keywords'];
            $query->where(function ($query) use ($value) {
                $query->orWhere('businesses.name', 'like', '%' . $value . '%');
            });
        }
        
        
        if (isset($args['sort'])) {
            $order = $args['order'] ?? 'asc';
            if ($args['sort'] == 'updated_date') {
                $query->orderBy('c.updated_at', $order);
            } else if ($args['sort'] == 'name') {
                $query->orderBy('businesses.name', $order);
            } else {
                $query->orderBy($args['sort'], $order);
            }
        } else {
            $query->orderBy('request', 'desc');
            $query->orderBy('c.updated_at', 'desc');
        }
        $limit = $args['limit'] ?? 25;
        $page = $args['page'] ?? 1;
        $skip = ($page - 1) * $limit;
        $query->where('c.user_id', $this->auth->id);
        if ($args['status'] == 1) {
            $query->where('c.pipeline', '<>', 'new');
        } else {
            $query->where('c.pipeline', 'new');
        }
        $query->select([
            'c.id as id',
            'c.*',
            'c.business_id',
            'candidate_resume_requests.id as request'
        ])->distinct();
        $query->from(DB::raw('candidates c'));
        $data = clone $query;
        $count = $data->distinct()->count('c.business_id');
        $query->having(DB::raw('c.updated_at'), '=', DB::raw('(SELECT max(updated_at) FROM candidates WHERE business_id = c.business_id)'));
        $query->take($limit)->skip($skip);
        $data = $query->with('last_wave')->get();
        
        return array(
            'items' => $data,
            'pages' => ceil($count / $limit),
            'count' => $count,
            'current_page' => $page,
            'token' => $this->token
        );
    }
}
