<?php

namespace App\User\Resume;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_availabilities';
    
    /**
     * Get the user that owns the availability.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
