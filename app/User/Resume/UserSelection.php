<?php

namespace App\User\Resume;

use Illuminate\Database\Eloquent\Model;

class UserSelection extends Model
{
    protected $fillable = [
        'user_id',
        'selections',
        'title',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
