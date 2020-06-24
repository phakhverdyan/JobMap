<?php

namespace App\Business;

use App\EloquentGetTableNameTrait;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use EloquentGetTableNameTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_administrators';

    const ADMIN_ROLE = 'admin';
    const MANAGER_ROLE = 'manager';
    // const BRANCH_ROLE = 'branch';
    const BRANCH_ROLE = 'franchisee';
    const FRANCHISE_ROLE = 'franchisee';

    /**
     * Get the business for the manager user
     */
    public function business()
    {
        return $this->belongsTo('App\Business');
    }

    /**
     * Get the user for the manager
     */
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    /**
     * Get the permissions for the administrator
     */
    public function permissions()
    {
        return $this->hasOne('App\Business\AdministratorPermission');
    }

    public function permits()
    {
        return $this->belongsToMany('App\Business\Permit', 'business_admin_permit', 'admin_id', 'permit_id')->withPivot('value', 'business_id');
    }

    /**
     * Get the locations for the manager
     */
    public function assign_locations()
    {
        return $this->hasMany('App\Business\ManagerLocation', 'administrator_id', 'id');
    }
}
