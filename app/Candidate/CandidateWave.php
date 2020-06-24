<?php

namespace App\Candidate;

use Illuminate\Database\Eloquent\Model;

class CandidateWave extends Model
{
	protected $dates = [
        'created_at',
        'updated_at',
        'expired_at'
    ];

    public function getTimeLeftAttribute() {
    	$time_left = $this->expired_at->getTimestamp() - time();
		return $time_left > 0 ? $time_left : 0;
    }

    public function getExpiredAtAttribute() {
    	return (new \DateTime)->setTimestamp($this->created_at->getTimestamp() + 30 * 86400);
    }
}
