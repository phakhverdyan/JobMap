<?php

namespace App\GraphQL\Mutation\User\Business\Applicant\Candidate;

use App\Business\Administrator;
use App\Candidate\Candidate;
use App\Candidate\History;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Mail;

class UpdatePipelineMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Update Pipeline for candidate'
    ];

    public function type()
    {
        return GraphQL::type('Candidate');
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
            'pipeline' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Pipeline type or id'
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'User id'
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
            Administrator::BRANCH_ROLE,
            Administrator::FRANCHISE_ROLE
        ];
        //set permissions for this object
        $this->permissions = [
            'candidates'
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();

        $business = \App\Business::where('id', $args['business_id'])->first();

        if (!$user = \App\User::where('id', $args['user_id'])->first()) {
            throw new \Exception('User not found');
        }

        if (!isset($args['pipeline']) || !$args['pipeline']) {
            throw new \Exception('Pipeline is not set');
        }

        $where = [
            'business_id' => $args['business_id'],
            'user_id' => $args['user_id']
        ];

        $candidates = Candidate::where($where)->get();

        if ($candidates->count() > 0) {
            foreach ($candidates as $candidate) {
                $candidate->pipeline = $args['pipeline'];
                $candidate->timestamps = false;
                $candidate->save();
            }

            $history = new History();
            $history->candidate_user_id = $args['user_id'];
            $history->manager_user_id = $this->auth->id;
            $history->business_id = $args['business_id'];
            $history->pipeline = $args['pipeline'];
            $history->save();

            Mail::to($user->email)->queue(new \App\Mail\UserMovedInPipeline($user, $business, 'INITIAL', $this->auth->language_prefix));
        }

        $candidates[0]['token'] = $this->token;
        return $candidates[0];
    }
}
