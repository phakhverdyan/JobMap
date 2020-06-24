<?php

namespace App\GraphQL\Mutation\User\Business;

use App\Business\Job;
use App\Business\JobLocation;
use App\GraphQL\Auth;
use App\GraphQL\AuthBusiness;
use Folklore\GraphQL\Error\ValidationError;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

class BuildCodeBitLyJobMutation extends Mutation
{
    //use JWT authorization
    use Auth;
    use AuthBusiness;

    protected $accessToken = 'a8eafaa7375b3be61f6a1bb93f36b319705e8e80';

    protected $attributes = [
        'name' => 'BuildCodeBitLyJob'
    ];
    
    public function type()
    {
        return GraphQL::type('CodeBitLyJob');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [
            /*'job' => ['required', 'string'],
            'location' => ['required', 'string'],*/
        ];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'job_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the job'
            ],
            'location_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the location'
            ],
            'job' => [
                'type' => Type::string(),
                'description' => 'The id of the job title'
            ],
            'location' => [
                'type' => Type::string(),
                'description' => 'The id of the location title'
            ],
            'location_no' => [
                'type' => Type::int(),
                'description' => 'The id of the location_no check'
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
            'job' => ['required', 'string'],
        ];
        if ($args['location_no'] == 0) {
            $rules = [
                'job' => ['required', 'string'],
                'location' => ['required', 'string'],
            ];
        }
        $validator = $this->getValidator($args, $rules);
        if ($validator->fails()) {
            throw with(new ValidationError('validation'))->setValidator($validator);
        }

        if ($args['location_no'] == 0) {
            $data = JobLocation::where('job_id', $args['job_id'])->where('location_id', $args['location_id'])->first();
            $code_bitly = $data->code_bitly;
            $longUrl = urlencode('http://jobmap.co/map/view/job/' . $data->id);//url("business/view/$data->id/$data->slug");
        } else {
            $data = Job::find($args['job_id']);
            $code_bitly = $data->code_bitly;
            $longUrl = urlencode('http://jobmap.co/map/view/job-union/' . $data->id);
        }

        if (!$code_bitly) {
            if( $curl = curl_init() ) {
                curl_setopt($curl, CURLOPT_URL, 'https://api-ssl.bitly.com/v3/shorten');
                curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
                //curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, "access_token=$this->accessToken&longUrl=$longUrl");
                $code_bitly = json_decode(curl_exec($curl))->data->url;
                curl_close($curl);
            }

            $data->code_bitly = $code_bitly;
            $data->save();
        }

        return [
            'code_bitly' => $code_bitly,
            'token' => $this->token,
        ];
    }
}
