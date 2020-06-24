<?php

namespace App\GraphQL\Type\User;

use App\GraphQL\Fields\AttachFileResumeField;
use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Fields\PictureResumeField;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A user'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the user'
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of user'
            ],
            'first_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The first name of user'
            ],
            'last_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The last name of user'
            ],
            'social_token' => [
                'type' => Type::string(),
                'description' => 'Social network token'
            ],
            'username' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Username'
            ],
            'password' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Password'
            ],
            'birth_date' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'User Birth Date'
            ],
            'street' => [
                'type' => Type::string(),
                'description' => 'User Street'
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
            'redirect_to' => [
                'type' => Type::string(),
                'description' => 'Redirect to'
            ],
            'phone_number' => [
                'type' => Type::string(),
                'description' => 'Mobile Phone'
            ],
            'phone_code' => [
                'name' => 'phone_code',
                'type' => Type::string(),
            ],
            'phone_country_code' => [
                'name' => 'phone_country_code',
                'type' => Type::string(),
            ],
            'attach_file' => AttachFileResumeField::class,
            'user_pic' => PictureResumeField::class,
            'user_pic_original' => [
                'type' => Type::string(),
                'description' => 'User Picture'
            ],
            'user_pic_options' => PictureResumeField::class,
            'user_pic_options_sm' => PictureResumeField::class,
            'user_pic_options_md' => PictureResumeField::class,
            'user_pic_custom' => [
                'type' => Type::string(),
                'description' => 'User Picture is Custom'
            ],
            'user_pic_filter' => [
                'type' => Type::string(),
                'description' => 'User Picture Filter'
            ],
            'user_pic_o' => PictureResumeField::class,
            'gender' => [
                'type' => Type::string(),
                'description' => 'User Gender from Social Media'
            ],
            'language' => [
                'type' => \GraphQL::type('Language'),
                'description' => 'User Language',
            ],
            'lang_prefix' => [
                'type' => Type::string(),
                'description' => 'User lang_prefix',

                'resolve' => function ($root, $args) {
                    return $root->language ? $root->language->prefix : 'en';
                }
            ],
            'last_active_business' => [
                'type' => Type::int(),
                'description' => 'Last Active Business'
            ],
            'chat_id' => [
                'type' => Type::int(),
                'description' => 'Chat id'
            ],
            'last_activity' => [
                'type' => Type::string(),
                'description' => 'User last_activity'
            ],
            'is_online' => [
                'type' => Type::int(),
                'description' => 'Business is online in chat'
            ],
            'realtime_token' => [
                'type' => Type::string(),
                'description' => 'The realtime token of the user',
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Create User',
                'resolve' => function ($root, $args) {
                    return $root['created_at']->format('M Y');
                }
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Updated User',
                'resolve' => function ($root, $args) {
                    $your_date = $root['updated_at']->timestamp;
                    $datediff = time() - $your_date;
                    $days = round($datediff / (60 * 60 * 24));

                    $dt = Carbon::now();
                    $d = ($days == 0) ? 'Today' : $dt->subDays($days)->diffForHumans();
                    return $d;
                }
            ],
            'verification_code' => [
                'type' => Type::string(),
                'description' => 'verification code',
            ],
            'verification_date' => [
                'type' => Type::string(),
                'description' => 'Create User',
                'resolve' => function ($root, $args) {
                    $verify = 'no';
                    if ($root['verification_date']) {
                        $datediff = time() - $root['verification_date']->timestamp;
                        $datediff = $datediff / (60 * 60);
                        if ($datediff > 24) {
                            $verify = 'endTime';
                        } else {
                            $verify = 'goTime';
                        }
                    }
                    return $verify;
                }
            ],
            'show_tooltip' => [
                'type' => Type::string(),
                'description' => 'show tooltip',
            ],
            'social' => [
                'type' => Type::string(),
                'description' => 'User data from social media',
                'resolve' => function ($root, $args) {
                    if ($root['social']) {
                        return $root['social']['social'];
                    } else {
                        return null;
                    }
                }
            ],
            'looking_job' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Looking job right now',
                'resolve' => function ($root, $args) {
                    if ($root['preference']) {
                        return $root['preference']['looking_job'];
                    } else {
                        return 'yes';
                    }
                }
            ],
            'new_job' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'New job opportunities',
                'resolve' => function ($root, $args) {
                    if ($root['preference']) {
                        return $root['preference']['new_job'];
                    } else {
                        return 'yes';
                    }
                }
            ],
            'its_urgent' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'its urgent job right now',
                'resolve' => function ($root, $args) {
                    if ($root['preference']) {
                        return $root['preference']['its_urgent'];
                    } else {
                        return 'yes';
                    }
                }
            ],
            'reference' => [
                'type' => \GraphQL::type('UserReference'),
                'description' => 'User References'
            ],
            'error_message' => [
                'type' => Type::string(),
                'description' => 'error_message',
            ],
            'run_first' => [
                'type' => Type::int(),
                'description' => 'run_first',
            ],
            'is_import' => [
                'type' => Type::int(),
                'description' => 'is_import',
            ],
            'on_email_send' => [
                'type' => Type::int(),
                'description' => 'on_email_send',
            ],
        ];
    }
}
