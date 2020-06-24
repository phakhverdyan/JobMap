<?php

namespace App\GraphQL\Type\User\Business;

use App\Business\Size;
use App\Candidate\Candidate;
use App\GraphQL\Fields\Business\BgPictureField;
use App\GraphQL\Fields\Business\CareerHtmlField;
use App\GraphQL\Fields\Business\HtmlField;
use App\GraphQL\Fields\Business\PictureField;
use App\GraphQL\Fields\Business\SidebarHtmlField;
use App\Industry;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class BusinessType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business',
        'description' => 'business user'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The id of the business'
            ],
            'parent_id' => [
                'type' => Type::id(),
                'description' => 'The parent_id of the business'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of business',
            ],
            'name_fr' => [
                'type' => Type::string(),
                'description' => 'The name of business on Franch',
            ],
            'localized_name' => [
                'type' => Type::string(),
                'description' => 'The localized name of business',
            ],
            'slug' => [
                'type' => Type::string(),
                'description' => 'The slug of business'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'The description of business'
            ],
            'description_fr' => [
                'type' => Type::string(),
                'description' => 'The description of business'
            ],
            'localized_description' => [
                'type' => Type::string(),
                'description' => 'The localized name of business',
            ],
            'assign_industries' => [
                'type' => Type::string(),
                'description' => 'The assign_industries of business',
                'resolve' => function ($root, $args) {
                    $ids = [];
                    if ($root['industries'] && count($root['industries']) >0) {
                        $ids = $root['industries']->pluck('id')->toArray();
                    } elseif ($root['industry_id']) {
                        $ids[] = $root['industry_id'];
                    }
                    return implode(",", $ids);
                }
            ],
            'industries' => [
                'type' => Type::listOf(\GraphQL::type('Industry')),
                'description' => 'The industries of business'
            ],
            'industry_id' => [
                'type' => Type::int(),
                'description' => 'The industry of business'
            ],
            'sub_industry_id' => [
                'type' => Type::int(),
                'description' => 'The sub-industry of business'
            ],
            'industry' => [
                'type' => Type::string(),
                'description' => 'The industry of business'
            ],
            'size_id' => [
                'type' => Type::int(),
                'description' => 'Business size'
            ],
            'keywords' => [
                'type' => Type::listOf(\GraphQL::type('Keyword'))
            ],
            'keywords_fr' => [
                'type' => Type::listOf(\GraphQL::type('Keyword'))
            ],
            'localized_keywords' => [
                'type' => Type::listOf(\GraphQL::type('Keyword'))
            ],
            'type' => [
                'type' => Type::string(),
                'description' => 'Business type',
                'resolve' => function ($root, $args) {
                    if ($root['type']) {
                        return trans('main.b_type_title.' . $root['type']);
                    }
                    $root['type'];
                }
            ],
            'type_value' => [
                'type' => Type::string(),
                'description' => 'Business type',
                'resolve' => function ($root, $args) {
                    return $root['type'];
                }
            ],
//            'industry' => [
//                'type' => Type::string(),
//                'description' => 'The industry name of business',
//
//                'resolve' => function ($root, $args) {
//                    $industry = Industry::where('id', $root['industry']['parent_id'])->first();
//                    return ($industry) ? $industry['name'] . ' - ' . $root['industry']['name'] . ' ' . $industry['name'] : null;
//                }
//            ],
            'website' => [
                'type' => Type::string(),
                'description' => 'The website of business'
            ],
            'website_fr' => [
                'type' => Type::string(),
                'description' => 'The website of business FR'
            ],
            'localized_website' => [
                'type' => Type::string(),
                'description' => 'The website of business (localized)'
            ],
            'direct_link' => [
                'type' => Type::string(),
                'description' => 'The direct link of business'
            ],
            'direct_link_fr' => [
                'type' => Type::string(),
                'description' => 'The direct link of business FR'
            ],
            'street' => [
                'type' => Type::string(),
                'description' => 'Business City'
            ],
            'street_number' => [
                'type' => Type::string(),
                'description' => 'Business Street Number'
            ],
            'suite' => [
                'type' => Type::string(),
                'description' => 'Business Suite'
            ],
            'latitude' => [
                'type' => Type::float(),
                'description' => 'Location Latitude'
            ],
            'longitude' => [
                'type' => Type::float(),
                'description' => 'Location Longitude'
            ],
            'phone_country_code' => [
                'type' => Type::string(),
                'description' => 'Phone Country Code'
            ],
            'phone_code' => [
                'type' => Type::string(),
                'description' => 'Phone code'
            ],
            'phone' => [
                'type' => Type::string(),
                'description' => 'Phone number'
            ],
            'zip_code' => [
                'type' => Type::string(),
                'description' => 'Zip Code'
            ],
            'plan_id' => [
                'type' => Type::int(),
                'description' => 'Plan id'
            ],
            'plan_type' => [
                'type' => Type::string(),
                'description' => 'Plan type'
            ],
            'billing_warning' => [
                'type' => Type::int(),
                'description' => 'Billing payment warning'
            ],
            'next_plan_id' => [
                'type' => Type::int(),
                'description' => 'Next plan id'
            ],
            'next_plan_type' => [
                'type' => Type::string(),
                'description' => 'Next plan type'
            ],
            'applicants' => [
                'type' => Type::int(),
                'description' => 'Total applicants'
            ],
            'city' => [
                'type' => Type::string(),
                'description' => 'Business City'
            ],
            'region' => [
                'type' => Type::string(),
                'description' => 'Business Region'
            ],
            'country' => [
                'type' => Type::string(),
                'description' => 'Business Country'
            ],
            'country_code' => [
                'type' => Type::string(),
                'description' => 'Business Country Code'
            ],
            'picture' => PictureField::class,
            'picture_50' => PictureField::class,
            'picture_100' => PictureField::class,
            'picture_200' => PictureField::class,
            'picture_o' => PictureField::class,
            'bg_picture' => BgPictureField::class,
            'picture_filename' => [
                'type' => Type::string(),
                'description' => 'Business picture_filename',
                'resolve' => function ($root, $args) {
                    return $root['picture'] ? $root['picture'] : '';
                }
            ],
            'images' => [
                'type' => Type::listOf(\GraphQL::type('BusinessImage')),
                'description' => 'BusinessImages',
                'resolve' => function ($root, $args) {
                    if (count($root['images']) > 0) {
                        return $root['images']->sortBy('number');
                    }
                    return $root['images'];
                }
            ],
            'admin' => [
                'type' => \GraphQL::type('BusinessAdministrator'),
                'description' => 'Administrator'
            ],
            'headquarters_count' => [
                'type' => Type::int(),
                'description' => 'Count locations with headquarter type'
            ],
            'locations_count' => [
                'type' => Type::int(),
                'description' => 'Count locations with location type',
                'resolve' => function ($root, $args) {
                    if (!is_null($root['locations_count'])) {
                        return $root['locations_count'];
                    } else {
                        return count($root['locations']);
                    }
                }
            ],
            'count_locations' => [
                'type' => Type::int(),
                'description' => 'Count locations all'
            ],
            'pages_locations' => [
                'type' => Type::int(),
                'description' => 'Count pages locations all'
            ],
            'jobs_count' => [
                'type' => Type::int(),
                'description' => 'Jobs count'
            ],
            'all_jobs_count' => [
                'type' => Type::int(),
                'description' => 'All jobs count by locations'
            ],
            'brands_count' => [
                'type' => Type::int(),
                'description' => 'Brands count'
            ],
            'jm_jobs_count' => [
                'type' => Type::int(),
                'description' => 'Jobs count',
                'resolve' => function ($root, $args) {
                    return count($root['jobs']);
                }
            ],
            'business_last_activity' => [
                'type' => Type::string(),
                'description' => 'Business last activity'
            ],
            'business_is_online' => [
                'type' => Type::int(),
                'description' => 'Business is online in chat'
            ],
            'stripe_id' => [
                'type' => Type::string(),
                'description' => 'Business stripe ID'
            ],
            'applicants_count' => [
                'type' => Type::int(),
                'description' => 'Applicants count',
                'resolve' => function ($root, $args) {
                    $query = Candidate::query()
                        ->join('users', 'users.id', '=', 'c.user_id');
                    $query->where('c.business_id', $root['id']);
                    $query->select([
                        'c.user_id as user_id',
                        'c.id as id',
                        'c.*',
                    ])->distinct();
                    $query->from(DB::raw('candidates c'));
                    $data = clone $query;
                    $count = $data->distinct()->count('c.user_id');

                    return $count;
                }
            ],
            'applicants_new_count' => [
                'type' => Type::int(),
                'description' => 'Applicants count',
                'resolve' => function ($root, $args) {
                    $query = Candidate::query()
                        ->join('users', 'users.id', '=', 'c.user_id');
                    $query->where('c.business_id', $root['id']);
                    $query->where('c.pipeline', 'new');
                    $query->select([
                        'c.user_id as user_id',
                        'c.id as id',
                        'c.*',
                    ])->distinct();
                    $query->from(DB::raw('candidates c'));
                    $data = clone $query;
                    $count = $data->distinct()->count('c.user_id');

                    return $count;
                }
            ],
            'count_of_clicked_candidates' => [
                'type' => Type::int(),
                'description' => 'Count of clicked on candidates',

                'resolve' => function ($root, $args) {
                    // get the `archived` pipeline
                    $archived_pipeline = \App\Business\Pipeline::where('business_id', $root['id'])->where('type_new', 'archived')->first();

                    $query = Candidate::query();
                    $query->where('business_id', $root['id']);
                    $query->where('business_clicked_on', 1);

                    if ($archived_pipeline) {
                        $query->where('pipeline', '!=', $archived_pipeline->id); // expect `Archived`
                    }

                    $count = $query->distinct('user_id')->count('user_id');
                    return $count;
                },
            ],
            'realtime_token' => [
                'type' => Type::string(),
                'description' => 'The realtime token of the business',
            ],
            'owner' => [
                'type' => Type::string(),
                'description' => 'Owner name',
            ],
            'first_name' => [
                'type' => Type::string(),
                'description' => 'First name',
            ],
            'last_name' => [
                'type' => Type::string(),
                'description' => 'Last name',
            ],
            'language' => [
                'type' => \GraphQL::type('Language'),
                'description' => 'Business main language',
            ],
            'language_id' => [
                'type' => Type::id(),
                'description' => 'Business main language id',
            ],
            // 'language_prefix' => [
            //     'type' => Type::id(),
            //     'description' => 'Default business prefix',

            //     'resolve' => function ($root, $args) {
            //         if ($root->language && $root->language->lang) {
            //             return $root->language->lang->prefix;
            //         }

            //         return null;
            //     }
            // ],
            // 'languages' => [
            //     'type' => Type::string(),
            //     'description' => 'Business languages',
            //     'resolve' => function ($root, $args) {
            //         $languages = [];
            //         foreach ($root['languages'] as $language) {
            //             $languages[] = $language['language_id'];
            //         }
            //         return implode(",", $languages);
            //     }
            // ],
            // 'languages_list' => [
            //     'type' => Type::listOf(\GraphQL::type('Language')),
            //     'description' => 'Business languages list',
            //     'resolve' => function ($root, $args) {
            //         $languages = [];
            //         foreach ($root['languagesList'] as $language) {
            //             $languages[] = [
            //                 'id' => $language['language_id'],
            //                 'name' => $language['lang']['name'],
            //                 'prefix' => $language['lang']['prefix']
            //             ];
            //         }
            //         return $languages;
            //     }
            // ],
            'integration_guide_steps' => [
                'type' => Type::string(),
                'description' => 'The integration_guide_steps of the business'
            ],
            'lets_get_started' => [
                'type' => Type::string(),
                'description' => 'The lets_get_started of the business'
            ],
            'integration_toggle' => [
                'type' => Type::int(),
                'description' => 'The integration_toggle of the business'
            ],
            'code_bitly' => [
                'type' => Type::string(),
                'description' => 'The code_bitly of the business'
            ],
            'new_start_here' => [
                'type' => Type::int(),
                'description' => 'The new_start_here of the business'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user'
            ],

            '_industry' => [
                'type' => Type::string(),
                'description' => 'The industry name of business',
                'resolve' => function ($root, $args) {
                    $str = '';
                    if ($root['industries'] && count($root['industries']) >0) {
                        $str = implode(", ", $root['industries']->pluck('localized_name')->toArray());
                    } elseif ($root['industry']) {
                        $str = $root['industry']->localized_name;
                    }

                    return $str;
                }
            ],
            '_sub_industry' => [
                'type' => Type::string(),
                'description' => 'The sub_industry name of business',

                'resolve' => function ($root, $args) {
                    if ($industry = Industry::where('id', $root['sub_industry_id'])->first()) {
                        if (App::getLocale() != 'en' && $industry->{'name_' . App::getLocale()}) {
                            return $industry->{'name_' . App::getLocale()};
                        }

                        return $industry->name;
                    }

                    return null;
                }
            ],
            '_size' => [
                'type' => Type::string(),
                'description' => 'The size name of business',
                'resolve' => function ($root, $args) {
                    return Size::where('id', $root['size_id'])->first()->name;
                }
            ],
            // '_languages' => [
            //     //'type' => Type::listOf(\GraphQL::type('Language')),
            //     'type' => Type::string(),
            //     'description' => 'Business languages list',
            //     'resolve' => function ($root, $args) {
            //         $languages = [];
            //         $langs = '';
            //         foreach ($root['languagesList'] as $language) {
            //             $langs .= ' ' . $language['lang']['name'];
            //             $languages[] = [
            //                 'id' => $language['language_id'],
            //                 'name' => $language['lang']['name'],
            //             ];
            //         }
            //         return $langs;
            //         return $languages;
            //     }
            // ],
            'first_plan_payment_was_at' => [
                'type' => Type::string(),
                'description' => 'The date of the first plan payment',

                'resolve' => function($root) {
                    return $root['first_plan_payment_was_at'] ? $root['first_plan_payment_was_at']->format(\DateTime::ATOM) : '';
                },
            ],
            'last_plan_payment_was_at' => [
                'type' => Type::string(),
                'description' => 'The date of the last plan payment',

                'resolve' => function($root) {
                    return $root['last_plan_payment_was_at'] ? $root['last_plan_payment_was_at']->format(\DateTime::ATOM) : '';
                },
            ],
            'error_message' => [
                'type' => Type::string(),
                'description' => 'error_message',
            ],
            'facebook' => [
                'type' => Type::string(),
                'description' => 'facebook',
            ],
            'facebook_fr' => [
                'type' => Type::string(),
                'description' => 'facebook FR'
            ],
            'localized_facebook' => [
                'type' => Type::string(),
                'description' => 'Localized facebook'
            ],
            'instagram' => [
                'type' => Type::string(),
                'description' => 'instagram',
            ],
            'instagram_fr' => [
                'type' => Type::string(),
                'description' => 'instagram FR'
            ],
            'localized_instagram' => [
                'type' => Type::string(),
                'description' => 'Localized instagram'
            ],
            'linkedin' => [
                'type' => Type::string(),
                'description' => 'linkedin',
            ],
            'linkedin_fr' => [
                'type' => Type::string(),
                'description' => 'linkedin FR'
            ],
            'localized_linkedin' => [
                'type' => Type::string(),
                'description' => 'Localized linkedin'
            ],
            'twitter' => [
                'type' => Type::string(),
                'description' => 'twitter',
            ],
            'twitter_fr' => [
                'type' => Type::string(),
                'description' => 'twitter FR'
            ],
            'localized_twitter' => [
                'type' => Type::string(),
                'description' => 'Localized twitter'
            ],
            'youtube' => [
                'type' => Type::string(),
                'description' => 'youtube',
            ],
            'youtube_fr' => [
                'type' => Type::string(),
                'description' => 'youtube FR'
            ],
            'localized_youtube' => [
                'type' => Type::string(),
                'description' => 'Localized youtube'
            ],
            'snapchat' => [
                'type' => Type::string(),
                'description' => 'snapchat',
                'resolve' => function($root) {
                    if (App::isLocale('fr')) {
                        return $root['snapchat_fr'];
                    }
                    return $root['snapchat'];
                },
            ],
            'snapchat_fr' => [
                'type' => Type::string(),
                'description' => 'snapchat FR'
            ],
            'localized_snapchat' => [
                'type' => Type::string(),
                'description' => 'Localized snapchat'
            ],
            // 'video' => [
            //     'type' => Type::string(),
            //     'description' => 'video',
            // ],
            // 'video_fr' => [
            //     'type' => Type::string(),
            //     'description' => 'video FR'
            // ],
            // 'localized_video' => [
            //     'type' => Type::string(),
            //     'description' => 'Localized video'
            // ],
            'run_first' => [
                'type' => Type::int(),
                'description' => 'run_first'
            ],

            'html' => HtmlField::class,
            'html_career' => CareerHtmlField::class,

            'locations' => [
                'type' => Type::listOf(\GraphQL::type('BusinessLocation')),
                'description' => 'Location Items'
            ],

            'indeed_account' => [
                'type' => \GraphQL::type('IndeedAccount'),
                'description' => 'Connected Indeed Account',
            ],
        ];
    }
}
