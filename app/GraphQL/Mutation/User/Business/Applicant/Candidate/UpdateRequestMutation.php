<?php

namespace App\GraphQL\Mutation\User\Business\Applicant\Candidate;

use App\Business\Administrator;
use App\Candidate\Candidate;
use App\Candidate\History;
use App\Candidate\ResumeRequest;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Mail;

class UpdateRequestMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'Update Resume request for candidate'
    ];
    
    public function type()
    {
        return Type::listOf(GraphQL::type('RequestResume'));
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
                'type' => Type::id(),
                'description' => 'Request id'
            ],
            'user_id' => [
                'type' => Type::id(),
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

        $business = \App\Business::where('id', $args['business_id'])->first();
        
        $where = [
            'business_id' => $args['business_id'],
            'request' => 1,
            'response' => 0
        ];

        if (isset($args['id'])) {
            $where['id'] = $args['id'];
        } else if (isset($args['user_id'])) {
            $where['user_id'] = $args['user_id'];
        }

        $query = ResumeRequest::query()->where($where);
        $data = $query->first();
        
        if ($data) {
            $userID = $data['user_id'];
    
            ResumeRequest::query()->where($where)->update([
                'request' => 1
            ]);
        } else {
            if (isset($args['user_id'])) {
                if (!$user = \App\User::where('id', $args['user_id'])->first()) {
                    throw new \Exception('User not found');
                }

                $userID = $args['user_id'];
                
                $send = new ResumeRequest();
                $send->user_id = $args['user_id'];
                $send->business_id = $args['business_id'];
                $send->request = 1;
                $send->response = 0;
                $send->save();

                Mail::to($user->email)->queue(new \App\Mail\UserUpdateRequest($user, $business, 'INITIAL', $this->auth->language_prefix));
            }
            else {
                return null;
            }
        }
    
        $data = ResumeRequest::where([
            'business_id' => $args['business_id'],
            'user_id' => $userID
        ])->orderBy('updated_at', 'desc')->get()->all();
        
        $data[0]['token'] = $this->token;
        
        return $data;
    }
}
