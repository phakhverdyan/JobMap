<?php

namespace App\User\Resume;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_certifications';
    
    /**
     * Get the user that owns the availability.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function _title()
    {
        return $this->belongsTo('App\Certificate', 'title_id');
    }
}
