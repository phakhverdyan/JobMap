<?php

namespace App\GraphQL\Mutation\User;

use App\Business;
use App\Candidate\Candidate;
use App\GraphQL\AuthToken;
use App\Mail\SendInvitationNewUserCandidate;
use App\User\Resume\Availability;
use App\User\Resume\BasicInfo;
use App\User\Resume\Preference;
use App\Rules\CheckValidGeo;
use Exception;
use Folklore\GraphQL\Error\ValidationError;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class UpdateImportMutation extends Mutation
{
    use AuthToken;

    protected $attributes = [
        'name' => 'updateUserImport'
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
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::id()),
            ],
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
            'pipeline_id' => [
                'name' => 'pipeline_id',
                'type' => Type::nonNull(Type::string()),
            ],
            'job_id' => [
                'name' => 'job_id',
                'type' => Type::id(),
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

        $candidate = Candidate::find($args['id']);
        $user = $candidate->user;

        $isSendMail =false;
        if ($user->email != $args['email']) {
            $isSendMail =true;
            $rules = [
                'email' => ['required', 'string', 'unique:users,email'],
            ];
            $validator = $this->getValidator($args, $rules);
            if ($validator->fails()) {
                throw with(new ValidationError('validation'))->setValidator($validator);
            }
        }

        DB::beginTransaction();

        try {
            $candidate = Candidate::find($args['id']);
            $user = $candidate->user;

            if ($isSendMail) {
                $password = str_random(8);
                $user->password = bcrypt($password);
                $user->verification_code = md5(str_random(32));
                $user->verification_date = time();
                Business\Import::where('email', $args['email'])->delete();
            }

            $candidate->pipeline = $args['pipeline_id'];
            $candidate->job_id = $args['job_id'] ? $args['job_id'] : null;
            $candidate->save();

            $user->first_name = $args['first_name'];
            $user->last_name = $args['last_name'];
            $user->email = $args['email'];
            $user->phone_number = $args['phone_number'];
            $user->phone_code = $args['phone_code'];
            $user->phone_country_code = $args['phone_country_code'];
            $user->city = $args['city'];
            $user->region = $args['region'];
            $user->country = $args['country'];
            $user->country_code = $args['country_code'];

            if (empty($args['first_name']) && empty($args['last_name'])) {
                $username = str_random(12);
            } else {
                $username = strtolower($args['first_name'] . $args['last_name']);
            }

            $user->username = $username;

            if (Input::has('delete_resume')) {
                $deleteResume = Input::get('delete_resume');
                if ($deleteResume) {
                    $user->attach_file = null;
                }
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
                        } else {
                            $errorMessage = $inputImage->getClientSize() . 'byte';
                        }

                    } catch (Exception $e) {

                    }
                }
            }

            $user->save();

        } catch (\Exception $e) {
            DB::rollback();
            return null;
        }

        if ($isSendMail) {

            $business = Business::find($candidate->business_id);
            Mail::to($user->email)->queue(new SendInvitationNewUserCandidate($business, $user, $password, 'INITIAL', $this->auth->language_prefix));

            // Mail::to(env('TEAM_EMAIL', 'atom-danil@yandex.ru'))->queue(new \App\Mail\UserCreated($user));
        }

        DB::commit();

        return [
            'pipeline' => $args['pipeline_id'],
            //'token' => $this->getToken(),
        ];
    }
}
