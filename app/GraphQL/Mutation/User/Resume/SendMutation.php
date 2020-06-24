<?php

namespace App\GraphQL\Mutation\User\Resume;

use App\Business\Location;
use App\Candidate\Candidate;
use App\GraphQL\Auth;
use App\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Mail;
use App\Mail\CandidateApplyJob;

class SendMutation extends Mutation
{
    //use JWT authorization
    use Auth;

    protected $attributes = [
        'name' => 'Send Resume to Business'
    ];

    public function type()
    {
        return GraphQL::type('Send');
    }

    protected function rules()
    {
        return [
            'business_id' => ['required']
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
                'description' => 'Business ID'
            ],
            'location_id' => [
                'type' => Type::id(),
                'description' => 'Location ID'
            ],
            'job_id' => [
                'type' => Type::id(),
                'description' => 'Job ID'
            ],
            'job_loc_id' => [
                'type' => Type::id(),
                'description' => 'Job Location ID'
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
        $where = [
            'business_id' => $args['business_id'],
            'user_id' => $this->auth->id,
            'location_id' => null,
            'job_id' => null
        ];

        if (!$business = \App\Business::where('id', $args['business_id'])->first()) {
            throw new \Exception('Business not found');
        }

        if (isset($args['location_id'])) {
            $where['location_id'] = $args['location_id'];
        }else{
            $location_query = Location::where("main", 1)->where("business_id", $args['business_id'])->first();
            if($location_query){
                $where['location_id'] = $location_query->id;
            }
        }

        if (isset($args['job_id'])) {
            $where['job_id'] = $args['job_id'];
        }

        $user = User::find($this->auth->id);

//        if (!($user['preference']['is_complete'] === 1 && $user['availability']['is_complete'] === 1 && $user['basic']['is_complete'] === 1
//                && ($user['preference']['not_education'] || $user['education']->count() > 0) && ($user['preference']['first_job'] !== null || $user['experience']->count() > 0))
//            && !$user['attach_file']) {
//            $data['message'] = 'It looks like your resume has missing important information.';
//            $data['status'] = 2;
//        }

        if ($user['resume_is_completed'] !== 1) {
            $data['message'] = 'It looks like your resume has missing important information.';
            $data['status'] = 2;
        } else {
            $candidate = Candidate::where($where)->first();

            if ($candidate) {
                $now = time();
                $date = date('Y-m-d H:i:s', strtotime('-' . config('services.send_resume_interval') . ' day', $now));

                if ($candidate['updated_at'] < $date) {
                    Candidate::where($where)->update([
                        'updated_at' => date('Y-m-d H:i:s'),
                        'pipeline' => 'new'
                    ]);

                    $data['message'] = 'Your resume has been resent';
                    $data['status'] = 1;
                }
                else {
                    $your_date = strtotime($candidate['updated_at']);
                    $datediff = $now - $your_date;

                    $left = config('services.send_resume_interval') - round($datediff / (60 * 60 * 24));
                    $data['message'] = 'You already sent a resume to this location. You can resend resumes after a ' . $left . ' day delay.';
                    $data['status'] = 3;
                }
            }
            else {
//                $candidate = Candidate::where([
//                    'business_id' => $args['business_id'],
//                    'user_id' => $this->auth->id
//                ])->first();

                $data = new Candidate;
                $data->user_id = $this->auth->id;
                $data->business_id = $args['business_id'];

                if (isset($args['location_id'])) {
                    $data->location_id = $args['location_id'];
                }else{
                    $location_query = Location::where("main", 1)->where("business_id", $args['business_id'])->first();
                    if($location_query){
                        $data->location_id = $location_query->id;
                    }
                }

                if (isset($args['job_id'])) {
                    $data->job_id = $args['job_id'];
                }

                $data->pipeline = 'new';

                $data->save();

                // $data->pipeline = ($candidate ? $candidate['pipeline'] : 'new');

                $data['message'] = 'Your resume has been sent';
                $data['status'] = 1;
                $candidate_job = \App\Business\Job::where('id', $data->job_id)->first();
                $candidate_location = \App\Business\Location::where('id', $data->location_id)->first();

                if ($candidate_location) {
                    // Send email each manager in candidate location
                    foreach ($candidate_location->managers as $location_manager) {
                        $manager = $location_manager->manager;
                        $user = $manager->user;
                        $email = $user->email;

                        if (!$email || $user->on_email_send != 1) {
                            continue;
                        }

                        if (isset($args['job_loc_id'])) {
                            $job_loc_id = $args['job_loc_id'];
                        } else {
                            $job_loc_id = false;
                        }

                        $job_url = $job_loc_id ? url('/map/view/job/' . $args['job_loc_id']) : '';

                        Mail::to($email)->queue(new CandidateApplyJob(
                            $candidate_location,
                            $candidate_job,
                            $this->auth,
                            $business->admin->user,
                            $business,
                            $candidate_job->localized_title,
                            $candidate_location->localized_name,
                            $job_url,
                            url('map/view/location/' . $candidate_location->getKey() . '/' . str_slug($candidate_location->name))
                        ));
                    }
                }

                if ($business->admin->user->verification_code) { // BUSINESS NOT CONFIRMED
                    Mail::to($business->admin->user->email)->queue(new \App\Mail\CandidateCreated(
                        $business->admin->user,
                        $business,
                        $this->auth,
                        $candidate_job,
                        $candidate_location,
                        false,
                        'INITIAL',
                        $this->auth->language_prefix
                    ));
                }
                else { // BUSINESS CONFIRMED
                    Mail::to($business->admin->user->email)->queue(new \App\Mail\CandidateCreated(
                        $business->admin->user,
                        $business,
                        $this->auth,
                        $candidate_job,
                        $candidate_location,
                        true,
                        'INITIAL',
                        $this->auth->language_prefix
                    ));
                }
            }
        }

        $data['token'] = $this->token;
        return $data;
    }
}
