<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'user_id',
        'business_id',
        'message',
    ];
}
