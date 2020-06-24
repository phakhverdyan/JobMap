<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_job_types';
    
    /**
     * Get the type
     */
    public function type()
    {
        return $this->hasOne('App\JobType', 'id', 'type_id');
    }
}
