<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class Pipeline extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_pipelines';

    public function getLocalizedNameAttribute() {
    	return get_localized_attribute($this, 'name');
    }
}
