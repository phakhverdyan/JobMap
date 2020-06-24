<?php

namespace App\GraphQL\Mutation\User\Business\Applicant\Pipeline;

use App\Business\Administrator;
use App\Business\Department;
use App\Business\Pipeline;
use App\Candidate\Candidate;
use App\Candidate\History;
use App\Candidate\Note;
use App\Candidate\ResumeRequest;
use App\Candidate\Viewed;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;

class DeleteMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'Delete Pipeline item'
    ];

    public function type()
    {
        return GraphQL::type('Pipeline');
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
                'description' => 'Pipeline id'
            ],
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Business id'
            ],
            'type' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Pipeline delete type'
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
            Administrator::BRANCH_ROLE
        ];
        //set permissions for this object
        $this->permissions = [
            'candidates'
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();

        $pipeline = Pipeline::where([
            'id' => $args['id'],
            'business_id' => $args['business_id']
        ])->first();

        if ($pipeline) {
            DB::beginTransaction();
            try {
                /*if ($pipeline['type'] !== 'custom') {
                    return null;
                }*/
                if ($pipeline['no_delete']) {
                    return null;
                }
                if ($args['type'] == 1) {
                    $candidates = Candidate::where([
                        'business_id' => $args['business_id'],
                        'pipeline' => $args['id']
                    ])->get()->all();

                    foreach ($candidates as $candidate) {
                        History::where([
                            'business_id' => $args['business_id'],
                            'candidate_user_id' => $candidate['user_id']
                        ])->delete();

                        Note::where([
                            'business_id' => $args['business_id'],
                            'candidate_user_id' => $candidate['user_id']
                        ])->delete();

                        Viewed::where([
                            'business_id' => $args['business_id'],
                            'candidate_user_id' => $candidate['user_id']
                        ])->delete();

                        ResumeRequest::where([
                            'business_id' => $args['business_id'],
                            'user_id' => $candidate['user_id']
                        ])->delete();
                        $candidate->delete();
                    }

                    if (!$pipeline->delete()) {
                        return null;
                    }
                } else if ($args['type'] == 2) {
                    $c = Candidate::where([
                        'business_id' => $args['business_id'],
                        'pipeline' => $args['id']
                    ])->get()->all();
                    foreach ($c as $item) {
                        // $item->pipeline = 'viewed';
                        $item->timestamps = false;
                        $item->save();
                    }
                    if (!$pipeline->delete()) {
                        return null;
                    }
                }
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                return null;
            }
        }

        $data['token'] = $this->token;
        $data['items'] = [];

        return $data;
    }
}
