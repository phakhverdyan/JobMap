<?php

namespace App\GraphQL\Mutation\User\Business\Job;

use App\Business\Administrator;
use App\Business\Job;
use App\Business\JobCareerLevel;
use App\Business\JobCertificate;
use App\Business\JobDepartment;
use App\Business\JobLanguage;
use App\Business\JobLocation;
use App\Business\JobQuestion;
use App\Business\JobQuestionAnswer;
use App\Business\JobType;
use App\CareerLevel;
use App\Certificate;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\Jobs\JobAutoExpiredContinued;
use App\WorldLanguage;
use Carbon\Carbon;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SaveAnswerQuestionJobMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;
    
    protected $attributes = [
        'name' => 'saveAnswerQuestionJob'
    ];
    
    public function type()
    {
        return GraphQL::type('JobQuestionAnswer');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'answer' => ['required', 'string'],
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'question_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'question_id'
            ],
            'answer' => [
                'type' => Type::string(),
                'description' => 'answer'
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
            'jobs'
        ];
        //set business ID
        $this->businessID = Cookie::get('business_id');
        //check permissions
        $this->check();

        DB::beginTransaction();
        try {

            $answer = JobQuestionAnswer::updateOrCreate(
                [ 'user_id' => $this->auth->id, 'question_id' => $args['question_id'] ],
                [ 'answer' => $args['answer'] ]
            );


            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return null;
        }


        $answer['token'] = $this->token;
        
        return $answer;
    }
}
