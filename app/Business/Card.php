<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    //use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_cards';
    //protected $dates = ['deleted_at'];

    /**
     * Get the business for the manager user
     */
    public function business()
    {
        return $this->belongsTo('App\Business');
    }
}
