<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class JobDepartment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_job_departments';
    
    /**
     * Get the department
     */
    public function department()
    {
        return $this->hasOne('App\Business\Department', 'id', 'department_id');
    }
}
