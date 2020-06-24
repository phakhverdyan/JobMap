<?php

namespace App\GraphQL\Mutation\User\Resume;

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

class UpdateResponseMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'Update Resume request for business'
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
                'type' => Type::nonNull(Type::id()),
                'description' => 'Request id'
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
        $where = [
            'id' => $args['id'],
            'request' => 1,
            'response' => 0
        ];
        
        $query = ResumeRequest::query()->where($where);
        $data = $query->first();
        
        if ($data) {
            ResumeRequest::query()->where($where)->update([
                'response' => 1
            ]);

            $user = \App\User::where('id', $data->user_id)->first();
            $business = \App\Business::where('id', $data->business_id)->first();
            Mail::to($business->admin->user->email)->queue(new \App\Mail\CandidateUpdatedProfile($business, $user, 'INITIAL', $this->auth->language_prefix));
        }
        
        $data = ResumeRequest::where([
            'user_id' => $this->auth->id
        ])->orderBy('updated_at', 'desc')->get()->all();
        
        $data[0]['token'] = $this->token;
        
        return $data;
    }
}
