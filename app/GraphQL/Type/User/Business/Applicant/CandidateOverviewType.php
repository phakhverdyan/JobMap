<?php

namespace App\GraphQL\Type\User\Business\Applicant;

use App\GraphQL\Fields\Business\Candidate\OverviewHtmlField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class CandidateOverviewType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business Candidate Overview',
        'description' => 'Business Candidate Overview'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'overview' => OverviewHtmlField::class,
            'download_resume' => [
                'type' => Type::string(),
                'description' => 'download_resume',
            ],
            'id' => [
                'type' => Type::int(),
                'description' => 'id candidate',
            ],
            'candidate_import' => [
                'type' => Type::int(),
                'description' => 'candidate_import',
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
        ];
    }
}
