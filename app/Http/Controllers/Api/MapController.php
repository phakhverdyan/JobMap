<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BaseCollectionResource;
use App\Business\Location;
use App\Business\BusinessUnconfirmedLocation;

class MapController extends Controller
{
    public function index(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'from_latitude' => 'required|numeric',
            'to_latitude' => 'required|numeric',
            'from_longitude' => 'required|numeric',
            'to_longitude' => 'required|numeric',
        ]);
        
        if ($validator->fails()) {
            return response([
                'error' => 'Validation',
                'validation_fields' => $validator->errors(),
            ], 400);
        }

        $from_latitude = (float) $request->input('from_latitude');
        $to_latitude = (float) $request->input('to_latitude');
        $from_longitude = (float) $request->input('from_longitude');
        $to_longitude = (float) $request->input('to_longitude');

        $from_latitude = max(-180.0, $from_latitude);
        $from_latitude = min(+180.0, $from_latitude);
        $to_latitude = max(-180.0, $to_latitude);
        $to_latitude = min(+180.0, $to_latitude);
        $from_longitude = max(-90.0, $from_longitude);
        $from_longitude = min(+90.0, $from_longitude);
        $to_longitude = max(-90.0, $to_longitude);
        $to_longitude = min(+90.0, $to_longitude);

        $location_query = Location::query();
        $location_query->where('latitude', '>=', $from_latitude);
        $location_query->where('latitude', '<=', $to_latitude);
        $location_query->where('longitude', '>=', $from_longitude);
        $location_query->where('longitude', '<=', $to_longitude);
        return $location_query->count();

        // return ;
    }

    public function locations(Request $request)
    {
    	$location_query = Location::select([
    		'id',
    		'name',
    		'name_fr',
    		'street',
    		'street_number',
    		'latitude',
    		'longitude',
    		'city',
    		'region',
    		'country',
    		'country_code',
    		'phone_country_code',
    		'phone_code',
    		'phone',
    		'business_id',
    		'updated_at',
    	]);

    	$location_query->with([
    		'business' => function ($query) {
    			$query->select([
    				'id',
    				'name',
    				'name_fr',
    				'slug',
                    'picture',
    			]);
    		},
    	]);

    	$location_query->orderBy('id', 'asc');

        //

    	$locations = $location_query->get();

        $location_groups = $locations->groupBy(function ($location) {
            return strval($location->latitude) . ',' . strval($location->longitude);
        })->map(function ($location_group, $location_group_key) {
            return [
                'id' => base64_encode($location_group_key),
                'locations' => $location_group,
                'latitude' => (float) explode(',', $location_group_key)[0],
                'longitude' => (float) explode(',', $location_group_key)[1],
            ];
        })->values();
    	
    	return [
            'data' => $location_groups->toArray(),
        ];
    }
}
