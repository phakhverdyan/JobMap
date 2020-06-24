<?php

namespace App\GraphQL\Mutation\User;

use App\Mail\VerificationUser;
use App\User;
use App\User\Academy\Director;
use App\User\Academy\Teacher;
use App\User\Resume\Availability;
use App\User\Resume\BasicInfo;
use App\User\Resume\Preference;
use App\UserSocials;
use Folklore\GraphQL\Error\ValidationError;
use GraphQL;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class CreateCandidateWaveMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Creating new candidate wave'
    ];
    
    public function type()
    {
        return GraphQL::type('CandidateWave');
    }
    
    /**
     * @return array
     */
    protected function rules()
    {
        return [];
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'candidate_id' => [
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
        if (!isset($args['candidate_id']) || !$args['candidate_id']) {
            return null;
        }

        if (!$candidate = \App\Candidate\Candidate::where('id', $args['candidate_id'])->first()) {
            throw new \Exception('Candidate not found');
        }

        $candidate_wave = $candidate->last_wave()->first();

        if ($candidate_wave && time() - $candidate_wave->created_at->getTimestamp() < 30 * 86400) {
            throw new \Exception('There is one active wave now');
        }

        $candidate_wave = new \App\Candidate\CandidateWave;
        $candidate_wave->candidate_id = $candidate->id;
        $candidate_wave->save();
        $candidate->last_wave_id = $candidate_wave->id;
        $candidate->save();

        realtime([
            ['type' => 'User', 'id' => $candidate->user_id],
            ['type' => 'Business', 'id' => $candidate->business_id],
        ])->emit('candidates.wave_was_created', [
            'candidate_id' => $candidate->id,
            'candidate_wave_id' => $candidate_wave->id,
        ]);

        $candidate_wave->token = $this->token;
        return $candidate_wave;
    }
}