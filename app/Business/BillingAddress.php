<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    protected $table = 'business_billing_addresses';

    public function business()
    {
        return $this->belongsTo('App\Business');
    }


}
