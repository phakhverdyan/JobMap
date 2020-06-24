<?php

namespace App\GraphQL\Type\User\Business\Applicant;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Carbon\Carbon;

class NoteType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Candidate note',
        'description' => 'Candidate note'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'manager' => [
                'type' => \GraphQL::type('User'),
            ],
            'message' => [
                'type' => Type::string(),
                'description' => 'Message',
            ],
            'id' => [
                'type' => Type::id(),
                'description' => 'id',
            ],
            'date' => [
                'type' => Type::string(),
                'description' => 'Date view',
                'resolve' => function ($root, $args) {
                    if (isset($root['date'])) {
                        return $root['date'];
                    } else {
                        $your_date = strtotime($root['updated_at']->format('Y-m-d H:i:s'));
                        $datediff = time() - $your_date;
                        $days = round($datediff / (60 * 60 * 24));
                        
                        $dt = Carbon::now();
                        $d = ($days == 0) ? 'Today' : $dt->subDays($days)->diffForHumans();
                        return $d;
                    }
                }
            ],
            'attach_file' => [
                'type' => Type::string(),
                'description' => 'filename',
            ],
            'rating' => [
                'type' => Type::int(),
                'description' => 'rating',
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
        ];
    }
}
