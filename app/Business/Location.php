<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'business_locations';

    protected $appends = [
        'localized_name',
        'full_address',
        'group_id',
    ];

    protected $casts = [
        'modification_stamp' => 'float',
    ];

    /**
     * Get the administrator for the business
     */
    public function admin()
    {
        return $this->hasMany('App\Business\Administrator', 'business_id', 'business_id');
    }

    /**
     * Get the user for the manager
     */
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    /**
     * Get the business for the user
     */
    public function business()
    {
        return $this->belongsTo('App\Business');
    }

    /**
     * Get the amenities for the location
     */
    public function amenities()
    {
        return $this->hasMany('App\Business\LocationAmenity');
    }

    /**
     * Get the managers for the location
     */
    public function managers()
    {
        return $this->hasMany('App\Business\ManagerLocation');
    }

    /**
     * Get the departments for the location
     */
    public function departments()
    {
        return $this->hasMany('App\Business\DepartmentLocation');
    }

    /**
     * Get the jobs for the location
     */
    public function jobs()
    {
        return $this->hasMany('App\Business\JobLocation');
    }

    public function getFullAddressAttribute()
    {
        $string = '';

        if ($this->street_number) {
            $string .= $this->street_number . ' ';
        }

        $string .= $this->street;

        if ($this->city) {
            $string .= ', ' . $this->city;
        }

        if ($this->region) {
            $string .= ', ' . $this->region;
        }

        $string .= ', ' . $this->country;

        return $string;
    }

    public function getGroupIdAttribute()
    {
        return base64_encode(strval($this->latitude) . ',' . strval($this->longitude));
    }

    public function getPictureAttribute()
    {
        if (!$this->attributes['picture']) {
            return null;
        }
        
        $filename = pathinfo($this->attributes['picture'], PATHINFO_FILENAME);
        
        return $filename . '.png';
    }

    /**
     * Localized fields
     */

    public function getLocalizedNameAttribute() {
        return get_localized_attribute($this, 'name');
    }

    public function getSlugAttribute()
    {
        return str_slug($this->name) ?: $this->business->slug;
    }

    // ---------------------------------------------------------------------- //

    public static function boot()
    {
        parent::boot();

        static::creating(function ($location) {
            $location->modification_stamp = time() + mt_rand() / mt_getrandmax();
        });

        static::updating(function ($location) {
            $location->modification_stamp = time() + mt_rand() / mt_getrandmax();
        });

        static::deleting(function ($location) {
            $location->amenities()->get()->each(function ($amenity) {
                $amenity->delete();
            });

            $location->managers()->get()->each(function ($manager) {
                $manager->delete();
            });

            $location->departments()->get()->each(function ($department) {
                $department->delete();
            });

            $location->jobs()->get()->each(function ($job_location) {
                $job_location->delete();
            });
        });
    }
}
