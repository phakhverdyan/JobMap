<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'name_fr',
        'key',
    ];

    public function getLocalizedNameAttribute() {
    	return get_localized_attribute($this, 'name');
    }
}
