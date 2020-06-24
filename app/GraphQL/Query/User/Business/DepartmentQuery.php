<?php

namespace App\GraphQL\Query\User\Business;

use App\Business\Department;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class DepartmentQuery extends Query
{
    protected $attributes = [
        'name' => 'Department'
    ];
    
    public function type()
    {
        return GraphQL::type('BusinessDepartment');
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the department'
            ],
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the business'
            ]
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args)
    {
        $query = Department::query();
        foreach ($args as $field => $value) {
            $query->where($field, $value);
        }
        $data = $query->first();
        
        return $data;
    }
}
