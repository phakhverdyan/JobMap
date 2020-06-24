<?php

namespace App\Business;

use App\EloquentGetTableNameTrait;
use Illuminate\Database\Eloquent\Model;

class WebsiteButtonStatistic extends Model
{
    use EloquentGetTableNameTrait;

    protected $table = 'business_website_buttons_statistics';

    /**
     * Get the amenities for the location
     */
    public function button()
    {
        return $this->hasOne('App\Business\WebsiteButton');
    }
}
