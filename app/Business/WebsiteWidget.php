<?php

namespace App\Business;

use App\EloquentGetTableNameTrait;
use Illuminate\Database\Eloquent\Model;

class WebsiteWidget extends Model
{
    use EloquentGetTableNameTrait;

    protected $table = 'business_website_widgets';

    /**
     * Get the brand for the user
     */
    public function brand()
    {
        return $this->belongsTo('App\Business', 'brand_id', 'id');
    }
}
