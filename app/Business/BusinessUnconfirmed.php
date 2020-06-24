<?php

namespace App\Business;
use Laravel\Cashier\Billable;
use Illuminate\Database\Eloquent\Model;

class BusinessUnconfirmed extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'businesses_unconfirmed';

    /**
     * Get the locations for the business
     */
    public function locations()
    {
        return $this->hasMany('App\Business\BusinessUnconfirmedLocation');
    }
    
    /**
     * Get the keywords for the business
     */
    public function keyword()
    {
        return $this->belongsTo('App\Business\BusinessUnconfirmedKeyword', 'keyword_id');
    }

    /**
     * Get the phones for the business
     */
    public function phones()
    {
        return $this->hasMany('App\Business\BusinessUnconfirmedPhone');
    }
}
