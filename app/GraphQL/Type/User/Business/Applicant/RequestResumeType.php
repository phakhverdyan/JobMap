<?php

namespace App\GraphQL\Type\User\Business\Applicant;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class RequestResumeType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Candidate resume requested',
        'description' => 'Candidate resume requested'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
            ],
            'response' => [
                'type' => Type::int(),
            ],
            'date' => [
                'type' => Type::string(),
                'description' => 'Date',
                'resolve' => function($root, $args){
                    $your_date = strtotime($root['updated_at']->format('Y-m-d H:i:s'));
                    $datediff = time() - $your_date;
                    $days = round($datediff / (60 * 60 * 24));
            
                    $d = ($days == 0) ? trans('fields.today') : trans('fields.days_ago', ['count' => $days]);
                    return $d;
                }
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
        ];
    }
}
