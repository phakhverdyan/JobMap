<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class ManagerLocation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_manager_locations';

    /**
     * Get the manager for the location
     */
    public function manager()
    {
        return $this->hasOne('App\Business\Administrator', 'id', 'administrator_id');
    }

    /**
     * Get the location for the manager
     */
    public function location()
    {
        return $this->hasOne('App\Business\Location', 'id', 'location_id');
    }
}
