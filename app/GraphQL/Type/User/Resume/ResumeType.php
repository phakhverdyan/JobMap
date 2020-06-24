<?php

namespace App\GraphQL\Type\User\Resume;

use App\GraphQL\Fields\PictureResumeField;
use App\GraphQL\Fields\Resume\OverviewHtmlField;
use App\GraphQL\Fields\Resume\PrintBuilderHtmlField;
use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ResumeType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Resume',
        'description' => 'Resume info for user'
    ];
    
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'preference' => [
                'type' => \GraphQL::type('UserPreference'),
                'description' => 'User Preference',
            ],
            'availability' => [
                'type' => \GraphQL::type('UserAvailability'),
                'description' => 'User Availability',
            ],
            'basic' => [
                'type' => \GraphQL::type('UserBasicInfo'),
                'description' => 'User Basic Info',
            ],
            'education' => [
                'type' => Type::listOf(\GraphQL::type('UserEducation')),
                'description' => 'User Educations',
            ],
            'experience' => [
                'type' => Type::listOf(\GraphQL::type('UserExperience')),
                'description' => 'User Experiences',
            ],
            'reference' => [
                'type' => Type::listOf(\GraphQL::type('UserReference')),
                'description' => 'User References',
                'resolve' => function($root, $args){
                    return $root['reference']->where('status','confirmed');
                }
            ],
            'skill' => [
                'type' => Type::listOf(\GraphQL::type('UserSkill')),
                'description' => 'User Skills',
            ],
            'languages' => [
                'type' => Type::listOf(\GraphQL::type('UserLanguage')),
                'description' => 'User Languages',
            ],
            'certification' => [
                'type' => Type::listOf(\GraphQL::type('UserCertification')),
                'description' => 'User Certifications',
            ],
            'distinction' => [
                'type' => Type::listOf(\GraphQL::type('UserDistinction')),
                'description' => 'User Distinctions',
            ],
            'hobby' => [
                'type' => Type::listOf(\GraphQL::type('UserHobby')),
                'description' => 'User Hobbies',
            ],
            'interest' => [
                'type' => Type::listOf(\GraphQL::type('UserInterest')),
                'description' => 'User Interests',
            ],
            'user_pic_options' => PictureResumeField::class,
            'is_complete' => [
                'type' => Type::int(),
                'description' => 'User Resume complete status',
                'resolve' => function($root, $args){
                    if (!($root['preference']['is_complete'] === 1 && $root['availability']['is_complete'] === 1 && $root['basic']['is_complete'] === 1
                            && ($root['preference']['not_education'] || $root['education']->count() > 0) && ($root['preference']['first_job'] !== null || $root['experience']->count() > 0))
                        && $root['attach_file']) {
                        return 0;
                    } else {
                        return 1;
                    }
                    /*if($root['preference']['is_complete'] === 1 && $root['availability']['is_complete'] === 1  && $root['basic']['is_complete'] === 1
                        && ($root['preference']['not_education'] || $root['education']->count() > 0) && ($root['preference']['first_job'] !== null || $root['experience']->count() > 0)){
                        return 1;
                    } else {
                        return 0;
                    }*/
                }
            ],
            'overview' => OverviewHtmlField::class,
            'print_builder' => PrintBuilderHtmlField::class,
            'selections' => [
                'type' => Type::listOf(\GraphQL::type('UserSelection')),
                'description' => 'User Selections',
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Update date',
                'resolve' => function($root, $args){
                    $your_date = $root['updated_at']->timestamp;
                    $datediff = time() - $your_date;
                    $days = round($datediff / (60*60*24));

                    $dt = Carbon::now();
                    $d = ($days == 0) ? 'Today' : $dt->subDays($days)->diffForHumans();
                    return $d;
                }
            ],
        ];
    }
}
