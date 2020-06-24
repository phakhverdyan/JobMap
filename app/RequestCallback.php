<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestCallback extends Model
{
    protected $fillable = [
        'email',
        'contact_name',
        'employer_name',
        'employer_number',
        'location_number',
        'phone',
        'extension',
        'message',
        'time',
        'country',
        'website',
        'business_name',
    ];
}
