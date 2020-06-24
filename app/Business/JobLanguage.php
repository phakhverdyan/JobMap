<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class JobLanguage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_job_languages';
    
    /**
     * Get the language
     */
    public function language()
    {
        return $this->hasOne('App\WorldLanguage', 'id', 'world_language_id');
    }
}
