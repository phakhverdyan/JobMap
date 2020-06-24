<?php

namespace App\User\Resume;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_experiences';
    
    /**
     * Get the user that owns the availability.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function industry()
    {
        return $this->belongsTo('App\Industry');
    }

    public function sub_industry()
    {
        return $this->belongsTo('App\Industry','sub_industry_id');
    }

    public function _title()
    {
        return $this->belongsTo('App\JobCategory', 'title_id');
    }
    public function _company()
    {
        return $this->belongsTo('App\Business', 'company_id');
    }
}
