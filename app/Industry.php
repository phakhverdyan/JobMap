<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    public function children()
    {
        return $this->hasMany('App\Industry', 'parent_id');
    }

    public function getLocalizedNameAttribute()
    {
    	return get_localized_attribute($this, 'name');
    }
}
