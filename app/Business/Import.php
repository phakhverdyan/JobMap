<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $table = 'business_imports';
    protected $dates = [
        'created_at', 'updated_at', 'sended_at'
    ];

    public function business()
    {
        return $this->belongsTo('App\Business');
    }
}
