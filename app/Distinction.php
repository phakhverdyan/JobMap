<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distinction extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'key',
    ];
}
