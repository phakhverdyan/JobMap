<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendUserProfile extends Model
{

    protected $fillable = [
        'user_id',
        'type',
        'email',
        'message'
    ];
}
