<?php

namespace App\GraphQL\Query\User\Business\Auth;

use App\Business;
use App\Business\JobQuestion;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\GraphQL\OptionalAuth;

class QuestionsJobQuery extends Query
{
    use OptionalAuth;

    protected $attributes = [
        'name' => 'QuestionsJob'
    ];
    
    public function type()
    {
        return GraphQL::type('JobQuestions');
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'job_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the job'
            ],
            'user_id' => [
                'type' => Type::id(),
                'description' => 'The id of the user'
            ],
            'locale' => [
                'type' => Type::string(),
                'description' => 'The locale'
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
        $userId = 0;
        if (isset($args['user_id'])) {
            $userId = $args['user_id'];
        }
        $data = JobQuestion::with(['answers' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
            }])->where('job_id', $args['job_id'])->get();
        //$data = JobQuestion::where('job_id', $args['job_id'])->get();
        
        return array(
            'items' => $data,
            'token' => $this->token,
        );
    }
}
