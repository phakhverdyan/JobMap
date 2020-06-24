<?php

namespace App\GraphQL\Mutation\User\Resume;

use App\GraphQL\Auth;
use App\User;
use App\User\Resume\Availability;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class UpdateAvailabilityMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    
    protected $attributes = [
        'name' => 'UpdateUserAvailability'
    ];
    
    public function type()
    {
        return GraphQL::type('UserAvailability');
    }
    
    protected function rules()
    {
        return [
            'full_time' => ['required', 'numeric'],
            'part_time' => ['required', 'numeric'],
            'internship' => ['required', 'numeric'],
            'contractual' => ['required', 'numeric'],
            'summer_positions' => ['required', 'numeric'],
            'recruitment' => ['required', 'numeric'],
            'field_placement' => ['required', 'numeric'],
            'volunteer' => ['required', 'numeric'],
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'full_time' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Available For Full Time'
            ],
            'part_time' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Available For Part Time'
            ],
            'internship' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Available For Intership'
            ],
            'contractual' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Available For Contractual'
            ],
            'summer_positions' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Available For Summer Positions'
            ],
            'recruitment' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Available For Graduate Year Recruitment Program'
            ],
            'field_placement' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Available For Field placement'
            ],
            'volunteer' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Available For Volunteer'
            ],
            'time_1' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Available For Morning'
            ],
            'time_2' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Available For Daytime'
            ],
            'time_3' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Available For Evening'
            ],
            'time_4' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Available For Night'
            ]
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return null
     */
    public function resolve($root, $args)
    {
        $update = [];
        
        foreach ($args as $field => $value) {
            $update[$field] = $value;
        }

        $update['is_complete'] = 1;
        Availability::where('user_id', $this->auth->id)->update($update);

        $query = Availability::query();
        $query->where('user_id', $this->auth->id);
        $availability = $query->first();
        $availability->token = $this->token;
        
        $user = User::find($this->auth->id);
        $user->recalculateResumeIsCompleted();
        $user->updated_at = $availability['updated_at'];
        $user->save();
    
        return $availability;
    }
}
