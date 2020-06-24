<?php

namespace App\GraphQL\Type\User\Resume;

use App\Candidate\Note;
use App\GraphQL\Fields\Resume\SentResumeHtmlField;
use Carbon\Carbon;
use App\Candidate\Candidate;
use App\Candidate\History;
use App\Candidate\ResumeRequest;
use App\Candidate\Viewed;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class SentResumeType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Sent Resume',
        'description' => 'Sent Resume'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Applicant id'
            ],
            'business' => [
                'type' => \GraphQL::type('Business'),
                'resolve' => function ($root, $args) {
                    return ($root['business']) ?? null;
                }
            ],
            'history' => [
                'type' => Type::listOf(\GraphQL::type('History')),
                'resolve' => function ($root, $args) {
                    $c = Candidate::where([
                        'user_id' => $root['user_id'],
                        'business_id' => $root['business_id'],
                    ])->get()->all();
                    
                    $response = [];
                    foreach ($c as $item) {
                        $response[] = [
                            'candidate' => $item,
                            'pipeline' => null,
                            'date' => $item['updated_at']->format('Y-m-d H:i:s')
                        ];
                    }
                    
                    return collect($response)->sortBy('date')->reverse()->toArray();
                }
            ],
            'html' => SentResumeHtmlField::class,
            'created_date' => [
                'type' => Type::string(),
                'description' => 'Candidate created date',
                'resolve' => function ($root, $args) {
                    if (isset($root['created_at'])) {
                        return $root['created_at']->format('M d, Y');
                    } else {
                        return null;
                    }
                }
            ],
            'updated_date' => [
                'type' => Type::string(),
                'description' => 'Candidate created date',
                'resolve' => function ($root, $args) {
                    if (isset($root['updated_at'])) {
                        return $root['updated_at']->format('M d, Y');
                    } else {
                        return null;
                    }
                    
                }
            ],
            'last_wave' => [
                'type' => \GraphQL::type('CandidateWave'),
                'description' => 'Last wave',
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
        ];
    }
}
