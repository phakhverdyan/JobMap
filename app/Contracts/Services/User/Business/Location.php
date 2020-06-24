<?php

namespace App\Contracts\Services\User\Business;

use Illuminate\Support\Collection;

interface Location
{
    /**
     * Check if given location already exists for business
     *
     * @param $businessID
     * @param $locationID
     * @param $latitude
     * @param $longitude
     * @return Boolean
     */
    public function checkLocationExistsForBusiness($businessID, $locationID, $latitude, $longitude): bool;

    /**
     * Get request args
     *
     * @param array $args
     * @return array
     */
    public function getStreetValidationArgs(array $args): array;
}
