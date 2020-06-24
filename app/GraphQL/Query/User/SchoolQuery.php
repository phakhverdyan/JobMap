<?php

namespace App\GraphQL\Query\User;

use App\User\Academy\Director;
use App\User\Academy\Student;
use App\User\Academy\Teacher;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class SchoolQuery extends Query
{
    
    protected $attributes = [
        'name' => 'School'
    ];
    
    public function type()
    {
        return GraphQL::type('School');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'name' => ['required', 'string']
        ];
    }
    /**
     * @return array
     */
    public function args()
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Type of user'
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
        $schoolName = $args['name'];
        $directors = Director::has('user')
            ->with(['teachers' => function ($query){
                $query->has('user');
            }])
            ->where('academy', $schoolName)
            ->get();
        $teachers = Teacher::has('user')
            ->with(['students' => function ($query){
                $query->has('user');
            }])
            ->where('academy', $schoolName)
            ->get();
        $studentsId = [];
        if ($teachers->count()){
            $studentsId = $teachers->pluck('students')->collapse()->pluck('id');
        }
        $students = [];
        if (count($studentsId)) {
            $students = Student::has('user')
                ->whereIn('id',$studentsId)
                ->get();
        }

        $schoolAddress = $directors->count() ? $directors->first()->city . ' ' . $directors->first()->region
            : ( $teachers->count() ? $teachers->first()->city . ' ' . $teachers->first()->region
                : ( $students->count() ? $students->first()->user->city . ' ' . $students->first()->user->region : ''));

        return [
            'name' => $schoolName,
            'address' => $schoolAddress,
            'directors' => $directors,
            'teachers' => $teachers ,
            'students' => $students,
        ];
    }
}
