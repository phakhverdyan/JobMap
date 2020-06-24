<?php

namespace App\User\Resume;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_references';
    
    /**
     * Get the user that owns the preference.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
