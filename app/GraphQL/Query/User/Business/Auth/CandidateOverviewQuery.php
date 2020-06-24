<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Business\Administrator;
use App\Candidate\Candidate;
use App\Candidate\Viewed;
use App\GraphQL\Extensions\AuthQuery;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class CandidateOverviewQuery extends AuthQuery
{
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Candidate Overview'
    ];

    public function type()
    {
        return GraphQL::type('CandidateOverview');
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
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the candidate'
            ],
            'locale' => [
                'type' => Type::string(),
                'description' => 'locale'
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
        //set authorized roles
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::BRANCH_ROLE
        ];
        //set permissions for this object
        $this->permissions = [
            'view_candidates'
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();

        $where = [
            'business_id' => $args['business_id'],
            'candidates.id' => $args['id'],
        ];
        $query = Candidate::query()
            ->join('users', 'users.id', '=', 'candidates.user_id');

        $query->where($where);
        $query->select([
            'candidates.id as id',
            'candidates.*',
        ]);
        $data = $query->first();

        if ($data) {
            $candidates = Candidate::where([
                'business_id' => $args['business_id'],
                'user_id' => $data['user_id'],
                'pipeline' => 'new'
            ])->get();
            // foreach ($candidates as $candidate){
            //     $candidate->pipeline = 'viewed';
            //     $candidate->timestamps = false;
            //     $candidate->save();
            // }

            $viewed = new Viewed();
            $viewed->candidate_user_id = $data['user_id'];
            $viewed->business_id = $args['business_id'];
            $viewed->manager_user_id = $this->auth->id;
            $viewed->save();
        }

        $download_resume = '';
        if (!($data['user']['preference']['is_complete'] === 1 && $data['user']['availability']['is_complete'] === 1 && $data['user']['basic']['is_complete'] === 1
            && ($data['user']['preference']['not_education'] || $data['user']['education']->count() > 0) && ($data['user']['preference']['first_job'] !== null || $data['user']['experience']->count() > 0))) {
            $download_resume = !empty($data['user']['attach_file']) ? Storage::disk('user_resume')->url('/' . $data['user']['id'] . '/') . $data['user']['attach_file'] . '?v=' . rand(11111, 99999) : '';
        }
        $candidate_import = 0;
        if ($data['user']['invite_business_id'] && !$data['user']['country_code'] && !$data['user']['country']) {
            $candidate_import = 1;
        }

        $data['download_resume'] = $download_resume;
        $data['candidate_import'] = $candidate_import;
        $data['token'] = $this->token;

        if (isset($args['locale'])) {
            App::setLocale($args['locale']);
        }

        return $data;
    }
}
