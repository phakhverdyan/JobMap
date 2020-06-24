<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class BusinessUnconfirmedLocation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_unconfirmed_locations';

    /**
     * Get the business
     */
    public function business()
    {
        return $this->belongsTo('App\Business\BusinessUnconfirmed','business_unconfirmed_id');
    }

}
