<?php

namespace App\User\Resume;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_languages';
    
    /**
     * Get the user that owns the preference.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
