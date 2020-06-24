<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class DepartmentLocation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_department_locations';
    
    /**
     * Get the department for the location
     */
    public function department()
    {
        return $this->hasOne('App\Business\Department', 'id', 'department_id');
    }
    
    /**
     * Get the location for the department
     */
    public function location()
    {
        return $this->hasOne('App\Business\Location', 'id', 'location_id');
    }
}
