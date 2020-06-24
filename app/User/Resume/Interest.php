<?php

namespace App\User\Resume;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_interests';
    
    /**
     * Get the user that owns the preference.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function _interest()
    {
        return $this->belongsTo('App\User\Resume\Autocomplete\Interest', 'title_id');
    }
}
