<?php

namespace App\Http\Controllers\Api;

use App\Country;
use App\GoogleAutocompleteQuery;
use App\Locality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AutocompleteController extends Controller
{
    public function cities(Request $request)
    {
    	$input = $request->validate([
			'string' => 'present|nullable|string',
            'country_code' => 'nullable|string|exists:countries,alpha2_code',
			'with_country' => 'boolean',
		]);

        if (!$input['string']) {
            return response()->resource([]);
        }
        
        $country = Country::where('alpha2_code', $input['country_code'] ?? null)->first();
    	
    	$googleAutocompleteQuery = GoogleAutocompleteQuery::getOrMake([
        	'input'     	=> $input['string'],
            'types'     	=> '(cities)',
            'components' 	=> ($country ? 'country:' . $country->alpha2_code : null),
            'language' 		=> app()->getLocale(),
        ]);
    	
    	$localityPredictions = array_values(array_filter($googleAutocompleteQuery->predictions, function ($prediction) {
    		return $prediction['type'] === 'locality';
	    }));
    	
        $countryShortNames = array_values(array_unique(array_map(function ($prediction) {
        	$fullAddressParts = explode(',', $prediction['full_address']);

        	return trim($fullAddressParts[count($fullAddressParts) - 1]);
        }, $localityPredictions)));

        $countryQuery = Country::query();

        if (app()->getLocale() === 'en') {
        	$countryQuery->selectRaw('countries.*, countries.short_name AS short_name');
        	$countryQuery->whereIn('countries.short_name', $countryShortNames);
        } else {
        	$countryQuery->selectRaw('countries.*, country_translations.short_name AS short_name');
        	$countryQuery->join('country_translations', 'countries.alpha2_code', '=', 'country_translations.country_code');
        	$countryQuery->where('country_translations.locale', app()->getLocale());
        	$countryQuery->whereIn('country_translations.short_name', $countryShortNames);
        }

        $countries = $countryQuery->get();
        
        $localities = array_map(function ($prediction) use ($countries, $request) {
        	$fullAddressParts = explode(',', $prediction['full_address']);
        	$predictionCountryShortName = trim($fullAddressParts[count($fullAddressParts) - 1]);
         
        	if ($country = $countries->where('short_name', $predictionCountryShortName)->first()) {
        		$prediction['country_code'] = $country->alpha2_code;
        		$prediction['country'] = $country;
        	} else {
		        if (!$locality = Locality::getOrMakeByKey($prediction['place_id'])) {
			        return null;
		        }
		
		        $prediction['country_code'] = $locality->country_code;
				$locality->load('country');
				$prediction['country'] = $locality->country;
	        }

        	$prediction['key'] = $prediction['place_id'];
        	unset($prediction['place_id']);
         
        	return $prediction;
        }, $localityPredictions);
        
        $localities = array_values(array_filter($localities, function ($locality) {
        	return $locality;
        }));
        
        foreach ($localities as &$locality) {
        	$shortAddressParts = explode(',', $locality['short_address']);
        	$locality['country_code'] = $locality['country']->alpha2_code;
        	$locality['country'] = $locality['country']->name;
        	$locality['region'] = trim(end($shortAddressParts));
        	$locality['city'] = trim($shortAddressParts[0]);
 		}

        return response()->resource($localities);
    }

    public function street(Request $request){
        $input = $request->validate([
            'string' => 'present|nullable|string',
            'city' => 'nullable|string',
        ]);
        if (!$input['string']) {
            return response()->resource([]);
        }

        $client = new \GuzzleHttp\Client;

        $params = [
            'input'     => $input['string'],
            'types'     => 'geocode',
            'sensor'    => false,
            //'key'       => 'AIzaSyD8yJT8MjaxPnzn3Nze33cDnmu7Uphc-3w',
            'key'       => env('GOOGLE_MAPS_API_KEY','AIzaSyD3mcG8oAZzzlCSGZt5B4u5h5LmBX1SgjE'),
            // 'strictbounds' => true,
        ];
//        if (isset($args['latitude']) && isset($args['longitude'])) {
//            $params['location'] = $args['latitude'] . ',' . $args['longitude'];
//            $params['radius'] = 50000;
//        }

        $responseR = $client->get('https://maps.googleapis.com/maps/api/place/autocomplete/json', [
            'query' => $params,
        ]);

        $resultArray = json_decode($responseR->getBody());
        $response = [];

        //set response data
        if ($resultArray->predictions) {
            $res = $resultArray->predictions;
            $i = 0;
            foreach ($res as $r) {
                $response[$i]['description'] = $r->description;
                $response[$i]['id'] = $r->id;
                $response[$i]['street'] = $r->structured_formatting->main_text;
                $response[$i]['url'] = 'https://maps.googleapis.com/maps/api/place/autocomplete/json';
                ++$i;
            }
        }

        return response()->resource($response);

    }
}
