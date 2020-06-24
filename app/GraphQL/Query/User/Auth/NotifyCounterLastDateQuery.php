<?php

namespace App\GraphQL\Query\User\Auth;

use App\Candidate\Candidate;
use App\Candidate\ResumeRequest;
use App\User\Resume\Reference;
use CandidateResumeRequestKeys;
use GraphQL;
use App\User;
use App\GraphQL\Extensions\AuthQuery;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;

class NotifyCounterLastDateQuery extends AuthQuery
{

    protected $attributes = [
        'name' => 'NotifyCounterLastDate User'
    ];

    public function type()
    {
        return GraphQL::type('NotifyCounterLastDateUser');
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
        ];
    }

    /**
     * @param $root
     * @param $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function resolve($root, $args)
    {
        $data = [];

        $data['references'] = Reference::where([
            'status' => 'incoming',
            'user_id' => $this->auth->id
        ])->count();

        //-start get
        $query = Candidate::query()
            ->join('users', 'users.id', '=', 'c.user_id')
            ->join('businesses', 'businesses.id', '=', 'c.business_id')
            ->leftJoin('candidate_resume_requests', function ($query) {
                $query->on('candidate_resume_requests.business_id', '=', 'c.business_id');
                $query->on('candidate_resume_requests.user_id', '=', 'c.user_id');
                $query->where('candidate_resume_requests.request', 1);
                $query->where('candidate_resume_requests.response', 0);
            });
        $query->where('c.user_id', $this->auth->id);
        $query->select([
            'c.id as id',
            'c.*',
            'c.business_id',
            'candidate_resume_requests.id as request'
        ])->distinct();
        $query->from(DB::raw('candidates c'));
        $candidates = $query->get();
        //-end get

        $data['sent_resumes'] = $candidates ? $candidates->count() : 0;
        $data['sent_resumes_new'] = 0;
        $data['sent_resumes_not_new'] = 0;
        $data['sent_resumes_ask_new'] = 0;
        $data['sent_resumes_ask_not_new'] = 0;
        if ($data['sent_resumes'] > 0)
        {
            $data['sent_resumes_companies'] = $candidates->pluck('business_id')->flip()->flip()->count();

            $candidates_new = $candidates->where('pipeline', 'new');
            $data['sent_resumes_new'] = $candidates_new->count();
            $arrayId = [];
            foreach ($candidates_new as $value) {
                if ($candidate_new_ask = ResumeRequest::where('user_id', $value->user_id)->where('business_id', $value->business_id)->where('request',1)->where('response',0)->first()) {
                    if (!in_array($candidate_new_ask->id,$arrayId)) {
                        $data['sent_resumes_ask_new']+=1;
                        $arrayId[] = $candidate_new_ask->id;
                    }
                }
            }

            $candidates_not_new = $candidates->where('pipeline', '!=','new');
            $data['sent_resumes_not_new'] = $candidates_not_new->count();
            $arrayId = [];
            foreach ($candidates_not_new as $value) {
                if ($candidate_not_new_ask = ResumeRequest::where('user_id', $value->user_id)->where('business_id', $value->business_id)->where('request',1)->where('response',0)->first()) {
                    if (!in_array($candidate_not_new_ask->id,$arrayId)) {
                        $data['sent_resumes_ask_not_new']+=1;
                        $arrayId[] = $candidate_not_new_ask->id;
                    }
                }
            }

            $data['sent_resumes_ask'] = $data['sent_resumes_ask_new'] + $data['sent_resumes_ask_not_new'];
        }
        $data['last_sent'] = $candidates ? $candidates->pluck('created_at')->max() : null;

        $user = User::with('preference',
            'availability',
            'basic',
            'education',
            'experience',
            'skill',
            'languages',
            'certification',
            'distinction',
            'hobby',
            'interest',
            'reference'
            )->find($this->auth->id);

        $data['resume_builder'] = 9 - ( optional($user->preference)->is_complete + optional($user->availability)->is_complete + optional($user->basic)->is_complete
            + (optional($user->preference)->not_education || optional($user->education)->count() > 0 ? 1 : 0)
            + (optional($user->preference)->first_job || optional($user->experience)->count() > 0 ? 1 : 0)
            + (optional($user->skill)->count() > 0 || optional($user->languages)->count() > 0 ? 1 : 0)
            + (optional($user->preference)->not_certification || optional($user->certification)->count() > 0 || optional($user->preference)->not_distinction || optional($user->distinction)->count() > 0 ? 1 : 0)
            + (optional($user)->hobby->count() > 0 || optional($user)->interest->count() > 0 ? 1 : 0)
            + (optional($user)->reference->where('status','confirmed')->count() > 0 ? 1 : 0) );

        $data['last_update'] = $user->updated_at;
        $data['last_viewed'] = optional($user->preference)->last_viewed;


        $data['token'] = $this->token;

        return $data;
    }
}
