<?php

namespace App\User\Resume;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_hobbies';
    
    /**
     * Get the user that owns the preference.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function _hobby()
    {
        return $this->belongsTo('App\User\Resume\Autocomplete\Interest', 'title_id');
    }
}
