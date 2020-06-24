<?php

namespace App\GraphQL\Mutation\User\Business\Job;

use App\Business;
use App\Business\Administrator;
use App\Business\Job;
use App\Business\JobCareerLevel;
use App\Business\JobCertificate;
use App\Business\JobDepartment;
use App\Business\JobKeyword;
use App\Business\JobLanguage;
use App\Business\JobLocation;
use App\Business\JobType;
use App\Business\Location;
use App\CareerLevel;
use App\Certificate;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use App\JobCategory;
use App\Jobs\JobAutoExpiredContinued;
use App\Keyword;
use App\WorldLanguage;
use Carbon\Carbon;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    //use business authorization
    use AuthBusiness;

    protected $attributes = [
        'name' => 'New Business Job'
    ];

    public function type()
    {
        return GraphQL::type('BusinessJob');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'title' => ['required_without:title_fr', 'string'],
            'title_fr' => ['required_without:title', 'string'],
            'description' => ['required_without:description_fr', 'string'],
            'description_fr' => ['required_without:description', 'string'],
            'type_key' => ['required', 'string', 'exists:job_types,key'],
            'hours' => ['numeric'],
        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'business_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'Business id'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'Job title'
            ],
            'title_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Job title_id'
            ],
            'title_fr' => [
                'type' => Type::string(),
                'description' => 'Job title FR'
            ],
            'title_fr_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Job title_fr_id'
            ],
            'category_id' => [
                'type' => Type::int(),
                'description' => 'Job category'
            ],
            'salary' => [
                'type' => Type::string(),
                'description' => 'Job salary'
            ],
            'salary_type' => [
                'type' => Type::string(),
                'description' => 'Job salary type'
            ],
            'type_key' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Job Type like: full-time, part-time, etc.',
            ],
            'hours' => [
                'type' => Type::int(),
                'description' => 'Hours or Week'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Job description'
            ],
            'description_fr' => [
                'type' => Type::string(),
                'description' => 'Job description FR'
            ],
            'notes' => [
                'type' => Type::string(),
                'description' => 'Job special notes'
            ],
            'notes_fr' => [
                'type' => Type::string(),
                'description' => 'Job special notes FR'
            ],
            'time_1' => [
                'type' => Type::string(),
                'description' => 'Available For Morning'
            ],
            'time_2' => [
                'type' => Type::string(),
                'description' => 'Available For Daytime'
            ],
            'time_3' => [
                'type' => Type::string(),
                'description' => 'Available For Evening'
            ],
            'time_4' => [
                'type' => Type::string(),
                'description' => 'Available For Night'
            ],
            'career_status' => [
                'type' => Type::string(),
                'description' => 'Career status for this job'
            ],
            'work_status' => [
                'type' => Type::string(),
                'description' => 'Work status for this job'
            ],
            'options' => [
                'type' => Type::string(),
                'description' => 'Options for this job'
            ],
            'status' => [
                'type' => Type::int(),
                'description' => 'Job status'
            ],
            'type' => [
                'type' => Type::int(),
                'description' => 'type assign/unassign all locations'
            ],
            'job_locations' => [
                'type' => Type::string(),
                'description' => 'Assign locations'
            ],
            'job_locations_detach' => [
                'type' => Type::string(),
                'description' => 'Assign locations'
            ],
            'departments' => [
                'type' => Type::string(),
                'description' => 'Assign departments'
            ],
            'careers' => [
                'type' => Type::string(),
                'description' => 'Career level'
            ],
            // 'types' => [
            //     'type' => Type::string(),
            //     'description' => 'Job Types'
            // ],
            'languages' => [
                'type' => Type::string(),
                'description' => 'Languages'
            ],
            'certificates' => [
                'type' => Type::string(),
                'description' => 'Certificates'
            ],
            // 'keywords' => [
            //     'type' => Type::string(),
            //     'description' => 'Keywords'
            // ],
            // 'keywords_fr' => [
            //     'type' => Type::string(),
            //     'description' => 'Keywords Fr'
            // ],
            'questions_t_detailed' => [
                'type' => Type::string(),
                'description' => 'questions_t_detailed'
            ],
            'questions_t_detailed_fr' => [
                'type' => Type::string(),
                'description' => 'questions_t_detailed Fr'
            ],
            'questions_t_onoff' => [
                'type' => Type::string(),
                'description' => 'questions_t_onoff'
            ],
            'questions_t_onoff_fr' => [
                'type' => Type::string(),
                'description' => 'questions_t_onoff Fr'
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return Job|null
     */
    public function resolve($root, $args)
    {
        //set authorized roles
        $this->roles = [
            Administrator::MANAGER_ROLE,
            Administrator::FRANCHISE_ROLE,
            //Administrator::BRANCH_ROLE
        ];
        //set permissions for this object
        $this->permissions = [
            'jobs'
        ];
        //set business ID
        $this->businessID = $args['business_id'];
        //check permissions
        $this->check();

        DB::beginTransaction();

        try {
            $data = new Job();
            if (isset($args['category_id']) && $args['category_id'] == 0) {
                $args['category_id'] = null;
            }

            foreach (['en', 'fr'] as $current_locale) {
                $language_injection = '';

                if ($current_locale != 'en') {
                    $language_injection = '_' . $current_locale;
                }

                if ($args['title' . $language_injection . '_id'] && !is_numeric($args['title' . $language_injection . '_id'])) {
                    $itemNew = 0;
                    $jc = JobCategory::where('name' . $language_injection, $args['title' . $language_injection . '_id'])->whereNull('parent_id')->first();

                    if ($jc) {
                        $itemNew = $jc->id;
                    }

                    if ($itemNew == 0) {
                        $newJC = JobCategory::create([
                            'parent_id' => 20800,
                            'name' . $language_injection => $args['title' . $language_injection . '_id'],
                        ]);

                        $itemNew = $newJC->id;
                    }

                    $args['title' . $language_injection . '_id'] = $itemNew;
                }
            }

            $excluded_fields_from_update = [
                'id',
                'job_locations',
                'job_locations_detach',
                'departments',
                'careers',
                // 'types',
                'languages',
                'certificates',
                'keywords',
                'keywords_fr',
                'questions_t_onoff',
                'questions_t_onoff_fr',
                'questions_t_detailed',
                'questions_t_detailed_fr',
                'type',
            ];

            foreach ($args as $field => $value) {
                if (!in_array($field, $excluded_fields_from_update)) {
                    $data->{$field} = $value;
                }
            }

            $data->user_id = $this->auth->id;
            $data->status = 1;
            $data->save();
            $dt = Carbon::create(date('Y'), date('m'), date('j'), date('H'), date('i'), date('s'));
            $jobQueue = (new JobAutoExpiredContinued($data->id))->delay($dt->addDay(Config::get('queue.day_job_expired')));
            //$jobQueue = (new JobAutoExpiredContinued($data->id))->delay($dt->addMinutes(1));
            $jobQueueId = app(Dispatcher::class)->dispatch($jobQueue);
            $data->job_id = $jobQueueId;
            $data->save();
            Log::info('--------------crete job------------------'.$jobQueueId.'---'.$data->id);

            if (!isset($args['id'])) {
                $args['id'] = $data->id;
            }

            if (isset($args['type'])) {
                switch ($args['type']) {
                    case 1:
                    case 3:
                        if ($args['type'] == 1) {
                            $businessIds = Business::where('parent_id', $args['business_id'])->select('id')->get()->pluck('id')->toArray();//
                            $businessIds[] = $args['business_id'];
                            $locationIds = Location::whereIn('business_id', $businessIds)->select('id')->get()->pluck('id')->toArray();
                        } else {
                            $locationIds = Location::where('business_id', $args['business_id'])->select('id')->get()->pluck('id')->toArray();
                        }
                        $dataInsert = [];
                        $jobStatus = null;
                        if ($job = Job::where(['id' => $args['id']])->first()) {
                            $jobStatus = $job->status;
                        };

                        foreach ($locationIds as $locationId) {
                            $dataInsert[] = array(
                                'job_id' => $args['id'],
                                'location_id' => $locationId,
                                'status' => $jobStatus,
                                'opened_at' => new \DateTime,
                            );
                        }

                        $jobLocation = new JobLocation();
                        $jobLocation->insert($dataInsert);
                        break;
                }
            } else {
                if (isset($args['job_locations']) && !empty($args['job_locations'])) {
                    $locations = explode(',', $args['job_locations']);
                    $locationsExist = JobLocation::whereIn('location_id', $locations)->get()->pluck('location_id')->toArray();
                    $dataInsert = [];

                    foreach ($locations as $location) {
                        if (!in_array($location, $locationsExist)) {
                            $dataInsert[] = array(
                                'job_id' => $args['id'],
                                'location_id' => $location,
                                'opened_at' => new \DateTime,
                            );
                        }
                    }

                    $jobLocation = new JobLocation();
                    $jobLocation->insert($dataInsert);
                }
            }

            if (isset($args['departments']) && !empty($args['departments'])) {
                $jobDepartment = new JobDepartment();
                $departments = explode(',', $args['departments']);
                $dataInsert = [];
                foreach ($departments as $department) {
                    $dataInsert[] = array(
                        'job_id' => $data['id'],
                        'department_id' => $department
                    );
                }
                $jobDepartment->insert($dataInsert);
            }

            if (isset($args['careers']) && !empty($args['careers'])) {
                $jobCareers = new JobCareerLevel();
                $careers = explode(',', $args['careers']);
                $dataInsert = [];
                foreach ($careers as $career) {
                    $find = CareerLevel::find($career);
                    if (!$find) {
                        $careerLevel = new CareerLevel();
                        $careerLevel->name = $career;
                        $careerLevel->save();
                        $career = $careerLevel['id'];
                    }
                    $dataInsert[] = array(
                        'job_id' => $data['id'],
                        'career_id' => $career
                    );
                }
                $jobCareers->insert($dataInsert);
            }

            // if (isset($args['types']) && !empty($args['types'])) {
            //     $jobTypes = new JobType();
            //     $types = explode(',', $args['types']);
            //     $dataInsert = [];
            //     foreach ($types as $type) {
            //         $dataInsert[] = array(
            //             'job_id' => $data['id'],
            //             'type_id' => $type
            //         );
            //     }
            //     $jobTypes->insert($dataInsert);
            // }

            if (isset($args['job_locations_detach']) && !empty($args['job_locations_detach'])) {
                JobLocation::where('job_id', $args['id'])->whereIn('location_id', explode(',', $args['job_locations_detach']))->delete();
            }

            if (isset($args['job_locations']) && !empty($args['job_locations'])) {
                $locations = explode(',', $args['job_locations']);
                //JobLocation::where($where)->whereNotIn('location_id', $locations)->delete();

                $dataInsert = [];
                $job = Job::where(['id' => $args['id']])->first();
                foreach ($locations as $location) {
                    $jobLocation = JobLocation::where([
                        'job_id' => $args['id'],
                        'location_id' => $location
                    ])->first();

                    if (!$jobLocation) {

                        $dataInsert[] = array(
                            'job_id' => $args['id'],
                            'location_id' => $location,
                            'status' => $job['status'],
                            'opened_at' => new \DateTime,
                        );
                    }
                }
                $jobLocation = new JobLocation();
                $jobLocation->insert($dataInsert);
            } /*else {
                $loc = Location::query()->where([
                    'business_id' => $args['business_id'],
                    'main' => 1
                ])->first();
                if($loc){
                    $dataInsert[] = array(
                        'job_id' => $args['id'],
                        'location_id' => $loc['id']
                    );
                    $jobLocation = new JobLocation();
                    $jobLocation->insert($dataInsert);
                }
            }*/

            if (isset($args['languages']) && !empty($args['languages'])) {
                $jobLanguages = new JobLanguage();
                $languages = explode(',', $args['languages']);
                $dataInsert = [];
                foreach ($languages as $language) {
                    $find = WorldLanguage::find($language);
                    if (!$find) {
                        $worldLanguage = new WorldLanguage();
                        $worldLanguage->name = $language;
                        $worldLanguage->save();
                        $language = $worldLanguage['id'];
                    }
                    $dataInsert[] = array(
                        'job_id' => $data['id'],
                        'world_language_id' => $language
                    );
                }
                $jobLanguages->insert($dataInsert);
            }

            if (isset($args['certificates']) && !empty($args['certificates'])) {
                $jobCertificates = new JobCertificate();
                $certificates = explode(',', $args['certificates']);
                $dataInsert = [];
                foreach ($certificates as $certificate) {
                    //$find = Certificate::find($certificate);
                    //if (!$find) {
                    if (!is_numeric($certificate)) {
                        $itemNew = 0;
                        if (App::isLocale('fr')) {
                            if ($jc = Certificate::where('name_fr',$certificate)->first()) {
                                $itemNew = $jc->id;
                            }
                        } else {
                            if ($jc = Certificate::where('name',$certificate)->first()) {
                                $itemNew = $jc->id;
                            }
                        }
                        if ($itemNew ==0) {
                            $cert = Certificate::create([
                                'name' => $certificate,
                                'name_fr' => $certificate
                            ]);
                            $itemNew = $cert->id;
                        }
                        $certificate = $itemNew;
                    }
                    $dataInsert[] = array(
                        'job_id' => $data['id'],
                        'certificate_id' => $certificate
                    );
                }
                $jobCertificates->insert($dataInsert);
            }

            // if (isset($args['keywords']) && !empty($args['keywords'])) {
            //     $jobKeywords = new JobKeyword();
            //     $keywords = explode(',', $args['keywords']);
            //     $dataInsert = [];
            //     foreach ($keywords as $keyword) {
            //         if (!is_numeric($keyword)) {
            //             $itemNew = 0;
            //             if ($jk = Keyword::where('name',$keyword)->where('language_prefix', 'en')->first()) {
            //                     $itemNew = $jk->id;
            //             }
            //             if ($itemNew ==0) {
            //                 $key = Keyword::create([
            //                     'name' => $keyword,
            //                     'language_prefix' => 'en',
            //                 ]);
            //                 $itemNew = $key->id;
            //             }
            //             $keyword = $itemNew;
            //         }
            //         $dataInsert[] = array(
            //             'job_id' => $data['id'],
            //             'keyword_id' => $keyword
            //         );
            //     }
            //     $jobKeywords->insert($dataInsert);
            // }

            // if (isset($args['keywords_fr']) && !empty($args['keywords_fr'])) {
            //     $jobKeywords = new JobKeyword();
            //     $keywords = explode(',', $args['keywords_fr']);
            //     $dataInsert = [];
            //     foreach ($keywords as $keyword) {
            //         if (!is_numeric($keyword)) {
            //             $itemNew = 0;
            //             if ($jk = Keyword::where('name',$keyword)->where('language_prefix', 'fr')->first()) {
            //                     $itemNew = $jk->id;
            //             }
            //             if ($itemNew ==0) {
            //                 $key = Keyword::create([
            //                     'name' => $keyword,
            //                     'language_prefix' => 'fr',
            //                 ]);
            //                 $itemNew = $key->id;
            //             }
            //             $keyword = $itemNew;
            //         }
            //         $dataInsert[] = array(
            //             'job_id' => $data['id'],
            //             'keyword_id' => $keyword
            //         );
            //     }
            //     $jobKeywords->insert($dataInsert);
            // }

            if (isset($args['questions_t_onoff']) && isset($args['questions_t_onoff_fr']) && !empty($args['questions_t_onoff']) && !empty($args['questions_t_onoff_fr'])) {
                $questions = explode(',', $args['questions_t_onoff']);
                $questions_fr = explode(',', $args['questions_t_onoff_fr']);
                $dataInsert = [];
                foreach ($questions as $key => $question) {
                    $dataInsert[] = [
                        'question' => $question,
                        'question_fr' => $questions_fr[$key],
                        'type' => '1',
                    ];
                }
                $data->questions()->createMany($dataInsert);
            }
            if (isset($args['questions_t_detailed']) && isset($args['questions_t_detailed_fr']) && !empty($args['questions_t_detailed']) && !empty($args['questions_t_detailed_fr'])) {
                $questions = explode(',', $args['questions_t_detailed']);
                $questions_fr = explode(',', $args['questions_t_detailed_fr']);
                $dataInsert = [];
                foreach ($questions as $key => $question) {
                    $dataInsert[] = [
                        'question' => $question,
                        'question_fr' => $questions_fr[$key],
                        'type' => '2',
                    ];
                }
                $data->questions()->createMany($dataInsert);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return null;
        }

        if (!$data) {
            return null;
        }

        $data['token'] = $this->token;

        return $data;
    }
}
