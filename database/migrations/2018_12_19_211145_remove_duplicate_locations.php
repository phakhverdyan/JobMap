<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Business;

class RemoveDuplicateLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $allBusiness = Business::with('locations')->get();

        foreach ($allBusiness as $business) {

            dump('Buissness: ' . $business->name);

            $businessLocations = $business->locations;

            $allLocations = [];

            foreach ($businessLocations as $location) {

                $businessLocation = [$location->latitude, $location->longitude];

                if (in_array($businessLocation, $allLocations)) {

                    dump(sprintf(
                        'Duplicate location (id: %d): %s (address: %s, %s - %s/%s)',
                        $location->getKey(),
                        $location->name,
                        $location->city,
                        $location->street,
                        $location->latitude,
                        $location->longitude
                    ));

                    if ($location->type != 'headquarter') {
                        $location->delete();
                        dump('^deleted');
                    }

                } else {
                    $allLocations[] = $businessLocation;
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
