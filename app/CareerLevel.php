<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CareerLevel extends Model
{
    public $timestamps = false;

    public function getLocalizedNameAttribute() {
    	return get_localized_attribute($this, 'name');
    }
}
