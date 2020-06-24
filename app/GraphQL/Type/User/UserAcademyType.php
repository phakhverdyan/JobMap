<?php

namespace App\GraphQL\Type\User;

use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class UserAcademyType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User Academy',
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The id of the user'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'first_name' => [
                'type' => Type::string(),
                'description' => 'The first name of user'
            ],
            'last_name' => [
                'type' => Type::string(),
                'description' => 'The last name of user'
            ],
            'city' => [
                'type' => Type::string(),
                'description' => 'User City',
            ],
            'region' => [
                'type' => Type::string(),
                'description' => 'User Region'
            ],
            'country' => [
                'type' => Type::string(),
                'description' => 'User Country'
            ],
            'country_code' => [
                'type' => Type::string(),
                'description' => 'User Country Code'
            ],
            'teaching' => [
                'type' => Type::string(),
                'description' => 'User Country'
            ],
            'academy' => [
                'type' => Type::string(),
                'description' => 'User Country Code'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
            'user_id' => [
                'type' => Type::id(),
                'description' => 'The user_id of the user'
            ],
            'user' => [
                'type' => \GraphQL::type('User'),
                'description' => 'The user_id of the user'
            ],
            'teachers' => [
                'type' => Type::listOf(\GraphQL::type('UserAcademy')),
                'description' => 'The user_id of the user'
            ],
            'students' => [
                'type' => Type::listOf(\GraphQL::type('UserAcademy')),
                'description' => 'The user_id of the user'
            ],
            'redirect' => [
                'type' => Type::string(),
                'description' => 'Mobile Phone'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Create User',
                'resolve' => function($root, $args){
                    return  $root['created_at']->format('M Y');
                }
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'date ago',
                'resolve' => function($root, $args){
                    $your_date = $root['updated_at']->timestamp;
                    $datediff = time() - $your_date;
                    $days = round($datediff / (60*60*24));

                    $dt = Carbon::now();
                    $d = ($days == 0) ? 'Today' : $dt->subDays($days)->diffForHumans();
                    return $d;
                }
            ],
            'location' => [
                'type' => Type::string(),
                'description' => 'location User',
                'resolve' => function($root, $args){
                    return $root['user']['city'] . ($root['user']['region'] ? ",".$root['user']['region'] : '') . ($root['user']['country'] ?  ",".$root['user']['country'] : '');
                }
            ],
        ];
    }
}
