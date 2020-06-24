<?php

namespace App\GraphQL\Type\User\Business\Applicant;

use App\Candidate\Note;
use Carbon\Carbon;
use App\Candidate\Candidate;
use App\Candidate\History;
use App\Candidate\ResumeRequest;
use App\Candidate\Viewed;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Illuminate\Support\Facades\App;
use App\Business\Administrator;

class CandidateType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Business Candidate',
        'description' => 'Business Candidate'
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'Applicant id'
            ],
            'business' => [
                'type' => \GraphQL::type('Business'),
                'resolve' => function ($root, $args) {
                    return ($root['business']) ?? null;
                }
            ],
            'user' => [
                'type' => \GraphQL::type('User'),
                'resolve' => function ($root, $args) {
                    return ($root['user']) ?? null;
                }
            ],
            'location' => [
                'type' => \GraphQL::type('BusinessLocation'),
                'resolve' => function ($root, $args) {
                    return ($root['location']) ?? null;
                }
            ],
            'viewed' => [
                'type' => Type::listOf(\GraphQL::type('Viewed')),
                'resolve' => function ($root, $args) {
                    $data = Viewed::where([
                        'candidate_user_id' => $root['user_id'],
                        'business_id' => $root['business_id'],
                    ])->orderBy('created_at', 'desc')->get()->all();

                    $response = [];
                    foreach ($data as $item) {
                        $your_date = $item['updated_at']->timestamp;
                        $datediff = time() - $your_date;
                        $days = round($datediff / (60 * 60 * 24));

                        Carbon::setLocale( App::getLocale());
                        $dt = Carbon::now();
                        $response[] = [
                            'manager' => $item['manager'],
                            'date' => ($days == 0) ? trans('fields.today') : $dt->subDays($days)->diffForHumans()
                        ];
                    }
                    return $response;
                }
            ],
            'notes' => [
                'type' => Type::listOf(\GraphQL::type('Note')),
                'resolve' => function ($root, $args) {
                    // $data = Note::where([
                    //     'candidate_user_id' => $root['user_id'],
                    //     'business_id' => $root['business_id'],
                    // ])->get()->all();

                    $queryData = [
                        'candidate_user_id' => $root['user_id'],
                        'business_id' => $root['business_id'],
                    ];

                    $authManagerRole = get_manager_role($root['business_id']);
                    if ($authManagerRole === Administrator::FRANCHISE_ROLE) {
                        $queryData['manager_user_id'] = auth()->user()->getKey();
                    }

                    $data = Note::where($queryData)->get()->all();

                    $response = [];
                    foreach ($data as $item) {
                        $your_date = $item['updated_at']->timestamp;
                        $datediff = time() - $your_date;
                        $days = round($datediff / (60 * 60 * 24));

                        Carbon::setLocale( App::getLocale());
                        $dt = Carbon::now();
                        $response[] = [
                            'id' => $item['id'],
                            'manager' => $item['manager'],
                            'message' => $item['message'],
                            'rating' => $item['rating'],
                            'attach_file' => $item['attach_file'],
                            'date' => ($days == 0) ? trans('fields.today') : $dt->subDays($days)->diffForHumans()
                        ];
                    }
                    return $response;
                }
            ],
            'history' => [
                'type' => Type::listOf(\GraphQL::type('History')),
                'resolve' => function ($root, $args) {

                    $queryDataHistory = [
                        'candidate_user_id' => $root['user_id'],
                        'business_id' => $root['business_id'],
                    ];

                    // $myLocations = get_my_locations($root['business_id']);
                    $authManagerRole = get_manager_role($root['business_id']);
                    if ($authManagerRole === Administrator::FRANCHISE_ROLE) {
                        $queryDataHistory['manager_user_id'] = auth()->user()->getKey();
                    }

                    $data = History::where($queryDataHistory)->get()->all();

                    $c = Candidate::where([
                        'user_id' => $root['user_id'],
                        'business_id' => $root['business_id'],
                    ])->get()->all();

                    $response = [];

                    foreach ($data as $item){
                        $response[] = [
                            'candidate' => null,
                            'pipeline' => $item,
                            'date' => $item['updated_at']->format('Y-m-d H:i:s')
                        ];
                    }

                    foreach ($c as $item){
                        $response[] = [
                            'candidate' => $item,
                            'pipeline' => null,
                            'date' => $item['updated_at']->format('Y-m-d H:i:s')
                        ];
                    }

                    return collect($response)->sortBy('date')->reverse()->toArray();
                }
            ],
            'requests' => [
                'type' => Type::listOf(\GraphQL::type('RequestResume')),
                'resolve' => function ($root, $args) {
                    $data = ResumeRequest::where([
                        'user_id' => $root['user_id'],
                        'business_id' => $root['business_id']
                    ])->orderBy('updated_at', 'desc')->get()->all();

                    return $data;
                }
            ],
            'job' => [
                'type' => \GraphQL::type('BusinessJob'),
                'resolve' => function($root, $args){
                    return ($root['job']) ?? null;
                }
            ],
            'html' => \App\GraphQL\Fields\Business\Candidate\HtmlField::class,
            'created_date' => [
                'type' => Type::string(),
                'description' => 'Candidate created date',
                'resolve' => function ($root, $args) {
                    if (isset($root['created_at'])) {
                        return $root['created_at']->format('M d, Y');
                    } else {
                        return null;
                    }
                }
            ],
            'updated_date' => [
                'type' => Type::string(),
                'description' => 'Candidate created date',
                'resolve' => function ($root, $args) {
                    if (isset($root['updated_at'])) {
                        return $root['updated_at']->format('M d, Y');
                    } else {
                        return null;
                    }

                }
            ],
            'date' => [
                'type' => Type::string(),
                'description' => 'Date',
                'resolve' => function($root, $args){
                    $your_date = $root['updated_at']->timestamp;
                    $datediff = time() - $your_date;
                    $days = round($datediff / (60 * 60 * 24));

                    Carbon::setLocale( App::getLocale());
                    $dt = Carbon::now();
                    $d = ($days == 0) ? trans('fields.today') : $dt->subDays($days)->diffForHumans();
                    return $d;
                }
            ],
            'pipeline' => [
                'type' => Type::string(),
                'description' => 'pipeline',
            ],
            'job_id' => [
                'type' => Type::int(),
                'description' => 'job_id',
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The auth token of the user',
            ],
            'user_video' => [
                'type' => Type::string(),
                'description' => 'user_video_id',
                'resolve' => function($root, $args){

                    return $root['user_video']['file_url'];
                }
            ],
            'thumbnail_url' => [
                'type' => Type::string(),
                'description' => 'user_video_id',
                'resolve' => function($root, $args){

                    return $root['user_video']['thumbnail_url'];
                }
            ],
        ];
    }
}
