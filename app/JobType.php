<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    public $timestamps = false;

    public $appends = [
    	'localized_name',
    ];

    public function getLocalizedNameAttribute() {
    	return get_localized_attribute($this, 'name');
    }
}
