<?php

namespace App\Candidate;

use Illuminate\Database\Eloquent\Model;

class Viewed extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'candidate_vieweds';
    
    /**
     * Get the manager
     */
    public function manager()
    {
        return $this->belongsTo('App\User', 'manager_user_id', 'id');
    }
}
