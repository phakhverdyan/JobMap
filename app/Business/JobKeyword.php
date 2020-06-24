<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class JobKeyword extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_job_keywords';
    
    /**
     * Get the keyword
     */
    public function keyword()
    {
        return $this->hasOne('App\Keyword', 'id', 'keyword_id');
    }
}
