<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Contracts\Services\User\Business\Location as LocationContract;

class CheckUniqueStreet implements Rule
{
    /**
     * Business ID
     */
    private $businessID;

    /**
     * Location ID
     */
    private $locationID;

    /**
     * Latitude location
     */
    private $latitude;

    /**
     * Longitude location
     */
    private $longitude;

    /**
     * Business location service
     */
    private $locationService;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($businessID, $locationID, $latitude, $longitude)
    {
        $this->locationService = app()->make(LocationContract::class);
        $this->businessID      = $businessID;
        $this->locationID      = $locationID;
        $this->latitude        = $latitude;
        $this->longitude       = $longitude;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->locationService
                    ->checkLocationExistsForBusiness(
                        $this->businessID,
                        $this->locationID,
                        $this->latitude,
                        $this->longitude
                    );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.custom.street_duplicate');
    }


}
