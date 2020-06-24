<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class LocationAmenity extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_location_amenities';
    
    /**
     * Get the amenity
     */
    public function amenity()
    {
        return $this->hasOne('App\Amenity', 'id', 'amenity_id');
    }
}
