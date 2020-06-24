<?php

namespace App\GraphQL\Mutation\User;

use App\Business;
use App\Candidate\Candidate;
use App\GraphQL\AuthToken;
use App\Mail\SendInvitationNewUserCandidate;
use App\Rules\CheckValidGeo;
use App\User\Resume\Availability;
use App\User\Resume\BasicInfo;
use App\User\Resume\Preference;
use Exception;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class CreateImportMutation extends Mutation
{
    use AuthToken;

    protected $attributes = [
        'name' => 'createUserNew'
    ];

    public function type()
    {
        return GraphQL::type('UserImport');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'first_name' => ['string'],
            'last_name' => ['string'],
            'email' => ['required', 'string', 'email'],
            'phone_number' => ['string'],
            'city' => ['string', new CheckValidGeo()],
        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'first_name' => [
                'name' => 'first_name',
                'type' => Type::string(),
            ],
            'last_name' => [
                'name' => 'last_name',
                'type' => Type::string(),
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
            ],
            'phone_number' => [
                'name' => 'phone_number',
                'type' => Type::string(),
            ],
            'phone_code' => [
                'name' => 'phone_code',
                'type' => Type::string(),
            ],
            'phone_country_code' => [
                'name' => 'phone_country_code',
                'type' => Type::string(),
            ],
            /*'pipeline_id' => [
                'name' => 'pipeline_id',
                'type' => Type::nonNull(Type::string()),
            ],*/
            'job_id' => [
                'name' => 'job_id',
                'type' => Type::id(),
            ],
            'invite_business_id' => [
                'name' => 'invite_business_id',
                'type' => Type::nonNull(Type::id()),
            ],
            'language_prefix' => [
                'name' => 'language_prefix',
                'type' => Type::nonNull(Type::string()),
            ],
            'city' => [
                'name' => 'city',
                'type' => Type::string(),
            ],
            'region' => [
                'name' => 'region',
                'type' => Type::string(),
            ],
            'country' => [
                'name' => 'country',
                'type' => Type::string(),
            ],
            'country_code' => [
                'name' => 'country_code',
                'type' => Type::string(),
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args)
    {

        DB::beginTransaction();

        $isExistUser = false;
        $pipelineId = 'ats';

        if ($user = User::where('email',$args['email'])->first()) {
            $isExistUser = true;
        } else {
            $create = [];
            foreach ($args as $k => $v) {
                //if ($k !== 'pipeline_id' && $k !== 'job_id') {
                if ($k !== 'job_id') {
                    $create[$k] = $v;
                }
            }

            if (empty($args['first_name']) && empty($args['last_name'])) {
                $username = str_random(12);
            } else {
                $username = strtolower($args['first_name'] . $args['last_name']);
            }

            $create['username'] = $username;
            $password = str_random(8);
            $create['password'] = bcrypt($password);
            $create['verification_code'] = md5(str_random(32));
            $create['verification_date'] = time();
            $create['show_tooltip'] = 'on';
            $create['is_import'] = 1;
            $create['invite_business_id'] = $args['invite_business_id'];

            $user = User::create($create);

            if (!$user) {
                return null;
            }

            if (Input::hasFile('attach_file')) {
                if (Input::file('attach_file')->isValid()) {
                    try {
                        ini_set('memory_limit', '-1');
                        $inputImage = Input::file('attach_file');
                        if ($inputImage->getClientSize() < 10000000) {
                            //$ext = $inputImage->getClientOriginalExtension();
                            //$fileName = md5('user-resume-attach-' . $this->auth->id);
                            $fileName = $inputImage->getClientOriginalName();
                            $storage = 'user/' . $user->id . '/resume/';
                            $originalImage = $fileName;// . '.' . $ext;
                            $inputImage->storeAs($storage, $originalImage);

                            $user->attach_file = $originalImage;
                            $user->save();
                        } else {
                            $errorMessage = $inputImage->getClientSize() . 'byte';
                        }

                    } catch (Exception $e) {

                    }
                }
            }

            try {
                $userPreference = new Preference();
                $userPreference->user_id = $user['id'];
                $userPreference->save();

                $userAvailability = new Availability();
                $userAvailability->user_id = $user['id'];
                $userAvailability->save();

                $userBasicInfo = new BasicInfo();
                $userBasicInfo->user_id = $user['id'];
                $userBasicInfo->headline = "";
                $userBasicInfo->about = "";
                $userBasicInfo->save();

            } catch (\Exception $e) {
                DB::rollback();
                return null;
            }



            $business = Business::find($user->invite_business_id);
            Mail::to($user->email)->queue(new SendInvitationNewUserCandidate($business, $user, $password, 'INITIAL', $this->auth->language_prefix));

            // Mail::to(env('TEAM_EMAIL', 'atom-danil@yandex.ru'))->queue(new \App\Mail\UserCreated($user));
        }

        $candidates =Candidate::where([
            'user_id' => $user->id,
            'business_id' => $args['invite_business_id']])
            ->get();
        if ($candidates->count() > 0) {
            foreach ($candidates as $candidate) {
                $candidate->pipeline = $pipelineId;//$args['pipeline_id'];
                if ($args['job_id']) {
                    $candidate->job_id = $args['job_id'];
                }
                $candidate->save();
            }
        } else {
            $candidate = new Candidate;
            $candidate->user_id = $user->id;
            $candidate->business_id = $args['invite_business_id'];
            $candidate->job_id = $args['job_id'] ? $args['job_id'] : null;
            $candidate->pipeline = $pipelineId;//$args['pipeline_id'];
            $candidate->save();
        }

        Business\Import::where('email', $user->email)->delete();

        DB::commit();

        return [
            'pipeline' => $pipelineId,//$args['pipeline_id'],
            //'pipeline' => $candidate->pipeline,
            //'token' => $this->getToken(),
        ];
    }
}
