<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Business\Location;
use App\Business;

class UpdateBusinessAndLocationsSlug extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Update locations
        $allBusiness = Business::all();

        foreach ($allBusiness as $business) {
            // Save FR version if EN is empty
            if (!empty($business->name_fr) && empty($business->name)) {
                $business->name = $business->name_fr;
            }
            if (!empty($business->description_fr) && empty($business->description)) {
                $business->description = $business->description_fr;
            }
            if (!$business->slug) {
                if ($business->name) {
                    $business->slug = str_slug($business->name);
                } elseif ($business->name_fr) {
                    $business->slug = str_slug($business->name_fr);
                }
            }
            $business->save();
        }

        // Update all locations
        $locations = Location::all();

        foreach ($locations as $location) {
            if (!empty($location->name_fr) && empty($location->name)) {
                $location->name = $location->name_fr;
                $location->save();
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
