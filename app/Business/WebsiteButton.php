<?php

namespace App\Business;

use App\EloquentGetTableNameTrait;
use Illuminate\Database\Eloquent\Model;

class WebsiteButton extends Model
{
    use EloquentGetTableNameTrait;

    protected $table = 'business_website_buttons';

    /**
     * Get the amenities for the location
     */
    public function statistic()
    {
        return $this->hasMany('App\Business\WebsiteButtonStatistic');
    }
}
