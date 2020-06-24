<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'business_discounts';

    public function business()
    {
        return $this->belongsTo('App\Business');
    }

    public function discounts()
    {
        return $this->belongsTo('App\Discount');
    }

}
