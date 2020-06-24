<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'name_fr',
    ];

    public function getLocalizedNameAttribute()
    {
    	return get_localized_attribute($this, 'name');
    }
}
