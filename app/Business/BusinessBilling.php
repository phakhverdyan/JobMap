<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class BusinessBilling extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_billings';

    /**
     * Get the business for the manager user
     */
    public function business()
    {
        return $this->belongsTo('App\Business');
    }
}

