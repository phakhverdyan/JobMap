<?php

namespace App\User\Academy;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'directors';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        /*'city',
        'region',
        'country',
        'country_code',*/
        'teaching',
        'academy',
        'token',
        'user_id',
    ];

    /**
     * Get the user that owns the availability.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the teachers that owns the availability.
     */
    public function teachers()
    {
        return $this->belongsToMany('App\User\Academy\Teacher');
    }
}
