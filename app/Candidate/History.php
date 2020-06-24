<?php

namespace App\Candidate;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'candidate_histories';
    
    /**
     * Get the business
     */
    public function business()
    {
        return $this->belongsTo('App\Business');
    }
    
    /**
     * Get the manager
     */
    public function manager()
    {
        return $this->hasOne('App\User', 'id', 'manager_user_id');
    }
    
    /**
     * Get the candidate
     */
    public function candidate()
    {
        return $this->hasOne('App\User', 'id', 'candidate_user_id');
    }
    
}
