<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;

class GoogleAutocompleteQuery extends Model
{
	public $casts = [
		'predictions' => 'array',
	];

	public function setPredictionsAttribute($value)
	{
		$this->attributes['predictions'] = json_encode($value, JSON_UNESCAPED_UNICODE);
	}

    public static function getOrMake($query)
    {
    	if (!env('GOOGLE_MAPS_API_KEY')) {
			throw new Exception('Google Maps API key is not set');
		}
    	
    	$query['components'] = $query['components'] ?? null;
        
    	$googleAutocompleteQueryQuery = GoogleAutocompleteQuery::query();
		$googleAutocompleteQueryQuery->where('input', $query['input']);
		$googleAutocompleteQueryQuery->where('types', $query['types']);
		$googleAutocompleteQueryQuery->where('components', $query['components']);
		$googleAutocompleteQueryQuery->where('language', $query['language']);

		if ($googleAutocompleteQuery = $googleAutocompleteQueryQuery->first()) {
			return $googleAutocompleteQuery;
		}

    	$client = new \GuzzleHttp\Client;

        $response = $client->get('https://maps.googleapis.com/maps/api/place/autocomplete/json', [
            'query' => [
            	'input'     	=> $query['input'],
	            'types'     	=> $query['types'],
	            'components' 	=> $query['components'],
	            'sensor'    	=> false,
	            'language' 		=> $query['language'],
	            'key'       	=> env('GOOGLE_MAPS_API_KEY'),
	        ],
        ]);

		$response = json_decode($response->getBody());
		
		if ($response->status !== 'OK') {
			throw new Exception($response->error_message);
		}
		
		$googleAutocompleteQuery = new GoogleAutocompleteQuery;
		$googleAutocompleteQuery->input = $query['input'];
		$googleAutocompleteQuery->types = $query['types'];
		$googleAutocompleteQuery->components = $query['components'];
		$googleAutocompleteQuery->language = $query['language'];

		$googleAutocompleteQuery->predictions = array_map(function ($prediction) {
			return [
				'full_address' => $prediction->description,
				'matched_substring' => $prediction->matched_substrings[0],
				'place_id' => $prediction->place_id,

				'short_address' => implode(', ', array_map(function ($term) {
					return $term->value;
				}, array_slice($prediction->terms, 0, -1))),

				'type' => $prediction->types[0],
			];
		}, $response->predictions ?? []);

		$googleAutocompleteQuery->save();

		return $googleAutocompleteQuery;
    }
}
