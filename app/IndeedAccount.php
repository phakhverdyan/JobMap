<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndeedAccount extends Model
{
    public $casts = [
    	'cookies' => 'array',
    ];
}
