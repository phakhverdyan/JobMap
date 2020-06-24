<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LocalityTranslation;
use App\Country;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Locality extends Model
{
	public $appends = [
		'name',
		'short_address',
		'full_address',
		'administrative_area_level_2',
		'administrative_area_level_1',
	];

	public $hidden = [
		'relevant_translation',
		'translations',
	];

	// ---------------------------------------------------------------------- //
	// 
	// - Attribute Methods
	// 
	// ---------------------------------------------------------------------- //

	public function getNameAttribute()
	{
		return get_localized_attribute($this, 'name');
	}

	public function getShortAddressAttribute()
	{
		return get_localized_attribute($this, 'short_address');
	}

	public function getFullAddressAttribute()
	{
		return get_localized_attribute($this, 'full_address');
	}

	public function getAdministrativeAreaLevel2Attribute()
	{
		return get_localized_attribute($this, 'administrative_area_level_2');
	}

	public function getAdministrativeAreaLevel1Attribute()
	{
		return get_localized_attribute($this, 'administrative_area_level_1');
	}

	// ---------------------------------------------------------------------- //
	// 
	// - Relation Methods
	// 
	// ---------------------------------------------------------------------- //

	public function country()
	{
		return $this->belongsTo(Country::class, 'country_code', 'alpha2_code');
	}

	public function translations()
	{
		return $this->hasMany(LocalityTranslation::class);
	}

	public function relevant_translation()
    {
        return $this->hasOne(LocalityTranslation::class)->where('locale', app()->getLocale());
    }

	// ---------------------------------------------------------------------- //
	// 
	// - Static Methods
	// 
	// ---------------------------------------------------------------------- //

    public static function getOrMakeByKey($key, $locale = null)
    {
    	if (!$key || !is_string($key)) {
    		return null;
    	}

    	$locale = $locale ?? app()->getLocale();
    	$localityQuery = Locality::query();
    	$localityQuery->where('key', $key);
    	
    	$localityQuery->with([
    		'translations',
    		'country',
    	]);

    	$locality = $localityQuery->first();

    	if ($locality && ($locale == 'en' || $locality->translations->where('locale', $locale)->first())) {
    		return $locality;
    	}

    	if (!$locality) {
    		if (!$englishPlace = self::getGooglePlaceById($key, 'en', true)) {
    			return null;
    		}
    		
    		$locality = new Locality;
    		$locality->key = $englishPlace->id;
    		$locality->name = $englishPlace->name;
	    	$locality->short_address = $englishPlace->short_address;
	    	$locality->full_address = $englishPlace->full_address;
	    	$locality->administrative_area_level_2 = $englishPlace->administrative_area_level_2;
	    	$locality->administrative_area_level_1 = $englishPlace->administrative_area_level_1;
		    $locality->country_code = $englishPlace->country_code;
		    $locality->postal_code = $englishPlace->postal_code;
		    $locality->latitude = $englishPlace->latitude;
		    $locality->longitude = $englishPlace->longitude;
		    $locality->timezone_code = $englishPlace->timezone_code;
		    $locality->setRelation('translations', collect());
			
		    try {
		    	$locality->save();
		    } catch (\Illuminate\Database\QueryException $exception) {
		    	if ($exception->errorInfo[1] == 1062) {
		    		$locality = Locality::where('key', $englishPlace->id)->first();
		    	} else {
		    		throw $exception;
		    	}
		    }

		    $countryQuery = Country::query();
		    $countryQuery->where('alpha2_code', $englishPlace->country_code);
		    $country = $countryQuery->firstOrFail();
	    	$country->name = $englishPlace->country_name;
	    	$country->short_name = $englishPlace->country_short_name;
	    	$country->save();
	    	$locality->setRelation('country', $country);
    	}

    	if ($locale != 'en' && !$locality->translations->where('locale', $locale)->first()) {
    		$translatedPlace = self::getGooglePlaceById($key, $locale, false);
	    	$localityTranslation = new LocalityTranslation;
	    	$localityTranslation->locality_id = $locality->id;
	    	$localityTranslation->locale = $locale;
	    	$localityTranslation->name = $translatedPlace->name;
	    	$localityTranslation->short_address = $translatedPlace->short_address;
	    	$localityTranslation->full_address = $translatedPlace->full_address;
	    	$localityTranslation->administrative_area_level_1 = $translatedPlace->administrative_area_level_1;
	    	$localityTranslation->administrative_area_level_2 = $translatedPlace->administrative_area_level_2;
	    	$localityTranslation->save();
	    	$locality->translations->push($localityTranslation);
	    	
	    	$countryTranslationQuery = CountryTranslation::query();
	    	$countryTranslationQuery->where('country_code', $translatedPlace->country_code);
	    	$countryTranslationQuery->where('locale', $locale);

	    	if (!$countryTranslation = $countryTranslationQuery->first()) {
	    		$countryTranslation = new CountryTranslation;
	    		$countryTranslation->country_code = $translatedPlace->country_code;
	    		$countryTranslation->locale = $locale;
	    		$countryTranslation->name = $translatedPlace->country_name;
	    		$countryTranslation->short_name = $translatedPlace->country_short_name;
	    		$locality->country->setRelation('relevant_translation', $countryTranslation);
	    	}

	    	$countryTranslation->save();
    	}

	    return $locality;
    }
    
    public static function getGooglePlaceById($placeId, $locale = null, $withTimezone = false)
	{
		if (!env('GOOGLE_MAPS_API_KEY')) {
			throw new Exception('Google Maps API key is not set');
		}
		
		$locale = $locale ?? app()->getLocale();
		$client = new \GuzzleHttp\Client;
	
	    $response = $client->get('https://maps.googleapis.com/maps/api/place/details/json', [
	        'query' => [
	            'placeid' => $placeId,
	            'key' => env('GOOGLE_MAPS_API_KEY'),
	            'language' => $locale,
	        ],
	    ]);
	
	    $body = json_decode($response->getBody());
	    $dom_document = new \DOMDocument;
		$dom_document->loadHTML('<' . '?xml encoding="utf-8" ?' . '>' . $body->result->adr_address);
		$spans = $dom_document->getElementsByTagName('span');
		$span_string_parts = [];
		$country_short_name = null;
	
		foreach ($spans as $span) {
			if ($span->getAttribute('class') != 'country-name') {
				continue;
			}
	
			$country_short_name = $span->nodeValue;
		}
	
		foreach ($spans as $span) {
			if (in_array($span->getAttribute('class'), ['country-name', 'postal-code'])) {
				continue;
			}
	
			$span_string_parts[] = $span->nodeValue;
		}
	
		$short_address = implode(', ', $span_string_parts);
	
	    $place = [
	        'id' => $body->result->place_id,
	        'name' => $body->result->name,
	        'short_address' => $short_address,
	        'full_address' => $body->result->formatted_address,
	        'latitude' => $body->result->geometry->location->lat,
	        'longitude' => $body->result->geometry->location->lng,
	        'administrative_area_level_2' => null,
	        'administrative_area_level_1' => null,
	        'postal_code' => null,
	        'country_code' => null,
	        'country_name' => null,
	        'country_short_name' => $country_short_name,
	        'type' => $body->result->types[0],
	    ];
	
	    foreach ($body->result->address_components as $address_component) {
	        if ($address_component->types[0] == 'administrative_area_level_2') {
	            $place['administrative_area_level_2'] = $address_component->long_name;
	            continue;
	        }
	
	        if ($address_component->types[0] == 'administrative_area_level_1') {
	            $place['administrative_area_level_1'] = $address_component->long_name;
	            continue;
	        }
	
	        if ($address_component->types[0] == 'country') {
	            $place['country_code'] = $address_component->short_name;
	            $place['country_name'] = $address_component->long_name;
	            continue;
	        }
	
	        if ($address_component->types[0] == 'postal_code') {
	            $place['postal_code'] = $address_component->long_name;
	            continue;
	        }
	    }
	
	    if (!$place['country_code']) {
	        return null;
	    }
	    
	    if ($withTimezone) {
			$response = $client->get('https://maps.googleapis.com/maps/api/timezone/json', [
				'query' => [
					'location' => $place['latitude'] . ',' . $place['longitude'],
					'timestamp' => time(),
					'key' => env('GOOGLE_MAPS_API_KEY'),
				],
			]);
		
			$body = json_decode($response->getBody());
		
			if ($body->status !== 'OK') {
				throw new \Exception('Cannot receive timezone');
			}
			
			$place['timezone_code'] = $body->timeZoneId;
		}
	
	    return (object) $place;
	}
}
