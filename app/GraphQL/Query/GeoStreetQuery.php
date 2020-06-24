<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class GeoStreetQuery extends Query
{

    protected $attributes = [
        'name' => 'geo'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('GeoStreet'));
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
            'latitude' => [
                'type' => Type::float(),
                'description' => 'Location Latitude'
            ],
            'longitude' => [
                'type' => Type::float(),
                'description' => 'Location Longitude'
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
        if (!isset($args['key'])) {
            return null;
        }

        //AIzaSyBbiUqr-4_YxXGMZGeTmC_KHPf979kgluY

        //send keywords to https://maps.googleapis.com/maps/api/place/autocomplete/json?input=key&types=(cities)&sensor=false&key=AIzaSyD8yJT8MjaxPnzn3Nze33cDnmu7Uphc-3w
                // $client = new \GuzzleHttp\Client;

                // $response = $client->get('https://maps.googleapis.com/maps/api/place/autocomplete/json', [
                //     'query' => [
                //         'input'     => urlencode($args['key']),
                //         'types'     => 'geocode',
                //         'sensor'    => false,
                //         'key'       => 'AIzaSyD8yJT8MjaxPnzn3Nze33cDnmu7Uphc-3w',
                //     ],
                // ]);

                // $response_data = \GuzzleHttp\json_decode((string) $response->getBody());
                // $results = [];

                // foreach ($response_data->predictions as $prediction) {
                //     $results[] = [
                //         'id'            => $prediction->id,
                //         'description'   => $prediction->description,
                //         'street'        => $prediction->structured_formatting->main_text,
                //         'url'           => '',

                //         'contry_code' => \App\Country::where(function($query) {
                //             $name = collect($prediction->terms)->last()->value;
                //             $query->where('name', $name);

                //             $query->orWhere('name', 'like', implode(' ', array_map(function($name_part) {
                //                 return $name_part[0] . '%';
                //             }, preg_split('/\s+/', $name))));
                //         })->first() ?: null,
                //     ];
                // }

                // dd($results);

        $client = new \GuzzleHttp\Client;

        $params = [
            'input'     => $args['key'],
            'types'     => 'geocode',
            'sensor'    => false,
            //'key'       => 'AIzaSyD8yJT8MjaxPnzn3Nze33cDnmu7Uphc-3w',
            'key'       => env('GOOGLE_MAPS_API_KEY','AIzaSyD3mcG8oAZzzlCSGZt5B4u5h5LmBX1SgjE'),
            // 'strictbounds' => true,
        ];
        if (isset($args['latitude']) && isset($args['longitude'])) {
            $params['location'] = $args['latitude'] . ',' . $args['longitude'];
            $params['radius'] = 50000;
        }

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

        return $response;
    }
}
