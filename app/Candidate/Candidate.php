<?php

namespace App\Candidate;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'candidates';
    
    public $timestamps = true;
    
    /**
     * Get the business
     */
    public function business()
    {
        return $this->belongsTo('App\Business');
    }
    
    /**
     * Get the user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    /**
     * Get the location
     */
    public function location()
    {
        return $this->belongsTo('App\Business\Location');
    }
    
    /**
     * Get the job
     */
    public function job()
    {
        return $this->belongsTo('App\Business\Job');
    }
    
    /**
     * Get the last wave
     */
    public function last_wave()
    {
        return $this->belongsTo('App\Candidate\CandidateWave');
    }

    public function user_video()
    {
        return $this->belongsTo('App\User\UserVideo');
    }
}
