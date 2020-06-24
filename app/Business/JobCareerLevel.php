<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class JobCareerLevel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_job_career_levels';
    
    /**
     * Get the career level
     */
    public function careerLevel()
    {
        return $this->hasOne('App\CareerLevel', 'id', 'career_id');
    }
}
