<?php

namespace App\Services\User\Business;

use DB;
use App\Business;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Contracts\Services\User\Business\Location as LocationContract;

class LocationService implements LocationContract
{
    /**
     * Check location exists for business
     *
     * @param $businessID
     * @param $locationID
     * @param $latitude
     * @param $longitude
     * @return boolean
     */
    public function checkLocationExistsForBusiness($businessID, $locationID, $latitude, $longitude): bool
    {
        $latitude = $this->truncateNumber($latitude);
        $longitude = $this->truncateNumber($longitude);

        $business = Business::find($businessID);
        $businessLocations = $business->locations()->where('id', '<>', $locationID)->get();

        foreach ($businessLocations as $location) {
            $locationLatitude = $this->truncateNumber($location->latitude);
            $locationlongitude = $this->truncateNumber($location->longitude);

            if ($locationLatitude === $latitude && $locationlongitude === $longitude) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get request args
     *
     * @param array $args
     * @return array
     */
    public function getStreetValidationArgs(array $args): array
    {
        if (!isset($args[1])) {
            return false;
        }

        $requestArgs = $args[1];

        return [
            $requestArgs['business_id'],
            $requestArgs['id'] ?? null,
            $requestArgs['latitude'],
            $requestArgs['longitude'],
        ];
    }

    /**
     * Truncate number
     *
     * @example truncate(-1.49999, 2); // returns -1.49
     * @example truncate(.49999, 3); // returns 0.499
     * @param float $number
     * @param int $number
     * @return float
     */
    private function truncateNumber($number, $precision = 5)
    {
        if(($p = strpos($number, '.')) !== false) {
            $number = floatval(substr($number, 0, $p + 1 + $precision));
        }
        return $number;
    }

}
