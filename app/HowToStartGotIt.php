<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HowToStartGotIt extends Model
{
    protected $fillable = [
        'business_id',
        'user_id',
        'type',
        'section'
    ];


}
