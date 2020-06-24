<?php

namespace App\User\Academy;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'students';

    protected $fillable = [
        'email',
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
