<?php

namespace App\GraphQL\Mutation\User\Widget;

use App\Business\Location;
use Storage;
use App\Business;
use App\Business\Import;
use App\Candidate\Candidate;
use App\GraphQL\AuthToken;
use App\Mail\BusinessNotifications;
use App\Mail\VerificationUser;
use App\Rules\CheckValidGeo;
use App\User\Resume\Availability;
use App\User\Resume\BasicInfo;
use App\User\Resume\Preference;
use App\UserSocials;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\User;
use Illuminate\Support\Facades\DB;
use Folklore\GraphQL\Error\ValidationError;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class CreateMutation extends Mutation
{
    use AuthToken;

    protected $attributes = [
        'name' => 'createWidgetUser'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    /**
     * @return array
     */
    protected function rules()
    {
        return [

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
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
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
            'type' => [
                'name' => 'type',
                'type' => Type::string(),
            ],
            'attach_file' => [
                'name' => 'attach_file',
                'type' => Type::string(),
            ],
            'applying_business_id' => [
                'type' => Type::id(),
            ],
            'applying_location_id' => [
                'type' => Type::id(),
            ],
            'applying_job_id' => [
                'type' => Type::id(),
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
        $rules = [
            'phone_number'          => ['required', 'string'],
            'city'                  => ['required', 'string', new CheckValidGeo()],
            'email'                 => ['required', 'string', 'unique:users,email'],
            'first_name'            => ['required', 'string'],
            'last_name'             => ['required', 'string'],
            'attach_file'           => ['string'],
        ];

        //set rules after authorize
        $validator = $this->getValidator($args, $rules);

        if ($validator->fails()) {
            throw with(new ValidationError('validation'))->setValidator($validator);
        }

        $generateRandPass = str_random(12);

        $this->credentials = [
            'email' => $args['email'],
            'password' => $generateRandPass
        ];

        DB::beginTransaction();

        $user = false;
        $args['language_prefix'] = 'en';
        $args['password'] = bcrypt($generateRandPass);
        $args['username'] = substr(md5($args['email']), mt_rand(0,8), 14);
        $args['verification_code'] = md5(str_random(32));
        $args['verification_date'] = time();
        $args['show_tooltip'] = 'on';
        $args['type'] = 'student';
        $args['login'] = 1;
        $args['inviting_business_id'] = 0;
        $user = User::create($args);

        if (!$user) {
            return null;
        }

        // Move CV file to user directory
        if (isset($args['attach_file'])) {
            $attachFileName = $args['attach_file'];
            $newFileName = merge_file_name($args['attach_file'], '-' . str_random(5));
            $userID = $user->getKey();

            $cvPath = config('files.widget.cv_tmp') . $attachFileName;
            $resumePath = config('files.widget.resume_path');
            $newCvPath = sprintf($resumePath, $userID, $newFileName);

            // Move file in user folder
            if (Storage::exists($cvPath)) {
                Storage::move($cvPath, $newCvPath);
                $user->attach_file = $newFileName;
                $user->save();
            }
        }

        // Send email to user
        Mail::to($user->email)->queue(
            new VerificationUser(
                $user,
                $user->language_prefix,
                'INITIAL',
                ['tmp_password' => $generateRandPass]
            )
        );

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

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return null;
        }

        if (isset($args['applying_business_id']) && $args['applying_business_id']) {
            if ($applying_business = Business::where('id', $args['applying_business_id'])->first()) {
                $candidate = new Candidate;
                $candidate->user_id = $user->id;
                $candidate->business_id = $applying_business->id;
                $candidate->location_id = null;
                $candidate->job_id = null;

                if (isset($args['applying_location_id']) && $args['applying_location_id']) {
                    $candidate->location_id = $args['applying_location_id'];
                }else{
                    $location_query = Location::where("main", 1)->where("business_id", $applying_business->id)->first();
                    if($location_query){
                        $candidate->location_id = $location_query->id;
                    }
                }

                if (isset($args['applying_job_id']) && $args['applying_job_id']) {
                    $candidate->job_id = $args['applying_job_id'];
                }

                $candidate->pipeline = 'new';
                $candidate->save();
                $candidate->status = 1;
                $applying_job = \App\Business\Job::where('id', $candidate->job_id)->first();
                $applying_location = \App\Business\Location::where('id', $candidate->location_id)->first();

                if ($applying_business->admin->user->verification_code) { // BUSINESS NOT CONFIRMED
                    Mail::to($applying_business->admin->user->email)->queue(new \App\Mail\CandidateCreated(
                        $applying_business->admin->user,
                        $applying_business,
                        $user,
                        $applying_job,
                        $applying_location,
                        false,
                        'INITIAL',
                        app()->getLocale()
                    ));
                } else { // BUSINESS CONFIRMED
                    Mail::to($applying_business->admin->user->email)->queue(new \App\Mail\CandidateCreated(
                        $applying_business->admin->user,
                        $applying_business,
                        $user,
                        $applying_job,
                        $applying_location,
                        true,
                        'INITIAL',
                        app()->getLocale()
                    ));
                }
            }
        }

        if (isset($args['login'])) {
            header("Set-Cookie: api-token=" . $this->getToken() . "; Domain=" . env('SESSION_DOMAIN') . "; EXPIRES 129600;path=/");
            $user->run_first = 1;
            $user->save();
        }

        $user['token'] = $this->getToken();

        return $user;
    }
}
