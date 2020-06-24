<?php

namespace App\User\Academy;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teachers';

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
     * Get the students that owns the availability.
     */
    public function students()
    {
        return $this->belongsToMany('App\User\Academy\Student');
    }

    /**
     * Get the directors that owns the availability.
     */
    public function directors()
    {
        return $this->belongsToMany('App\User\Academy\Director');
    }
}
