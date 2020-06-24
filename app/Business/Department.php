<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_departments';
    
    /**
     * Get the administrator for the business
     */
    public function admin()
    {
        return $this->hasMany('App\Business\Administrator', 'business_id', 'business_id');
    }

    /**
     * Get the user for the manager
     */
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    /**
     * Get the business for the user
     */
    public function business()
    {
        return $this->belongsTo('App\Business');
    }
    
    /**
     * Get the locations for the department
     */
    public function locations()
    {
        return $this->hasMany('App\Business\DepartmentLocation');
    }

    public function getLocalizedNameAttribute() {
        return get_localized_attribute($this, 'name');
    }
}
