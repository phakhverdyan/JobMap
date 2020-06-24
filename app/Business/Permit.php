<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    protected $table = 'permits';
    protected $fillable = [
        'type',
        'slug',
        'title',
        'title_fr',
    ];

    const MANAGER_TYPE = 'manager';
    const FRANCHISEE_TYPE = 'franchisee';

    public function admins()
    {
        return $this->belongsToMany('App\Business\Administrator', 'business_admin_permit', 'admin_id', 'permit_id');
    }

    public function getLocalizedTitleAttribute() {
        return get_localized_attribute($this, 'title');
    }
}
