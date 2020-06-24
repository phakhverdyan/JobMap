<?php

namespace App\GraphQL\Query;

use App\Country;
use App\GoogleAutocompleteQuery;
use App\Locality;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class GeoQuery extends Query
{
    
    protected $attributes = [
        'name' => 'geo'
    ];
    
    public function type()
    {
        return Type::listOf(GraphQL::type('Geo'));
    }
    
    /**
     * @return array
     */
    public function args()
    {
        return [
            'key' => [
                'type' => Type::string(),
                'description' => 'Keywords'
            ],
        ];
    }
    
    /**
     * @param $root
     * @param $args
     * @return array|null
     */
    public function resolve($root, $args)
    {
        $country = null;
    	
    	$googleAutocompleteQuery = GoogleAutocompleteQuery::getOrMake([
        	'input'     	=> $args['key'],
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
        
        $localities = array_map(function ($prediction) use ($countries, $args) {
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
        	$locality['fullName'] = $locality['full_address'];
        	$locality['countryCode'] = $locality['country']->alpha2_code;
        	$locality['city'] = trim($shortAddressParts[0]);
        	unset($shortAddressParts[0]);
        	$locality['country'] = $locality['country']->name;
        	$locality['region'] = trim($shortAddressParts[count($shortAddressParts) - 1] ?? '');
 		}
        
        return $localities;
    }
}
