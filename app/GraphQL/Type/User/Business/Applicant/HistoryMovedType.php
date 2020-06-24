<?php

namespace App\GraphQL\Type\User\Business\Applicant;

use App\Business\Pipeline;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Carbon\Carbon;

class HistoryMovedType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Candidate history',
        'description' => 'Candidate history moved by pipeline'
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
            'candidate' => [
                'type' => \GraphQL::type('User'),
            ],
            'pipeline' => [
                'type' => Type::string(),
                'description' => 'Pipeline name',
                'resolve' => function ($root, $args) {
                    $data = Pipeline::where('business_id', $root['business_id'])
                        ->where(function ($query) use ($root) {
                            $query->orWhere('type', $root['pipeline']);
                            $query->orWhere('id', $root['pipeline']);
                        })->first();
                    
                    return $data['name'];
                }
            ],
            'date' => [
                'type' => Type::string(),
                'description' => 'Date',
                'resolve' => function ($root) {
                    $your_date = $root['updated_at']->timestamp;
                    $datediff = time() - $your_date;
                    $days = round($datediff / (60 * 60 * 24));
                    
                    $dt = Carbon::now();
                    $d = ($days == 0) ? 'Today' : $dt->subDays($days)->diffForHumans();
                    return $d;
                }
            ],
        ];
    }
}
