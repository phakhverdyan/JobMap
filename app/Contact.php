<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'language',
        'type',
        'subject',
        'email',
        'phone',
        'full_name',
        'message'
    ];

}
