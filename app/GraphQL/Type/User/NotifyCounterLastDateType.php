<?php

namespace App\GraphQL\Type\User;

use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class NotifyCounterLastDateType extends GraphQLType
{
    protected $attributes = [
        'name' => 'NotifyCounter type',
        'description' => 'NotifyCounter type'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'references' => [
                'type' => Type::int(),
                'description' => 'references incoming counter'
            ],
            'sent_resumes' => [
                'type' => Type::int(),
                'description' => 'send resume counter'
            ],
            'sent_resumes_new' => [
                'type' => Type::int(),
                'description' => 'send resume counter'
            ],
            'sent_resumes_not_new' => [
                'type' => Type::int(),
                'description' => 'send resume counter'
            ],
            'sent_resumes_ask' => [
                'type' => Type::int(),
                'description' => 'send resume counter'
            ],
            'sent_resumes_ask_new' => [
                'type' => Type::int(),
                'description' => 'send resume counter'
            ],
            'sent_resumes_ask_not_new' => [
                'type' => Type::int(),
                'description' => 'send resume counter'
            ],
            'sent_resumes_companies' => [
                'type' => Type::int(),
                'description' => 'send resume counter'
            ],
            'last_sent' => [
                'type' => Type::string(),
                'description' => 'last sent resume',
                'resolve' => function($root, $args){
                    if (!$root['last_sent']) {
                        return '';
                    }
                    $your_date = $root['last_sent']->timestamp;
                    $datediff = time() - $your_date;
                    $days = round($datediff / (60*60*24));

                    $dt = Carbon::now();
                    $d = ($days == 0) ? 'Today' : $dt->subDays($days)->diffForHumans();
                    return $d;
                }
            ],
            'resume_builder' => [
                'type' => Type::int(),
                'description' => 'resume builder counter'
            ],
            'last_update' => [
                'type' => Type::string(),
                'description' => 'last last_update resume builder',
                'resolve' => function($root, $args){
                    $your_date = $root['last_update']->timestamp;
                    $datediff = time() - $your_date;
                    $days = round($datediff / (60*60*24));

                    $dt = Carbon::now();
                    $d = ($days == 0) ? 'Today' : $dt->subDays($days)->diffForHumans();
                    return $d;
                }
            ],
            'last_viewed' => [
                'type' => Type::string(),
                'description' => 'last last_viewed resume builder',
                'resolve' => function($root, $args){
                    $date = $root['last_viewed'] ? $root['last_viewed'] : $root['last_update'];
                    $your_date = $date->timestamp;
                    $datediff = time() - $your_date;
                    $days = round($datediff / (60*60*24));

                    $dt = Carbon::now();
                    $d = ($days == 0) ? 'Today' : $dt->subDays($days)->diffForHumans();
                    return $d;
                }
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],
        ];
    }
}
