<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'billings';

    /**
     * Get the business for the manager user
     */
    public function business()
    {
        return $this->belongsTo('App\Business');
    }

    public function coupon()
    {
        return $this->belongsTo('App\Coupon');
    }

    public function plan()
    {
        return $this->belongsTo('App\MonthlyPlan');
    }

    public function package()
    {
        return $this->belongsTo('App\AddonPackage');
    }
}
