<?php

namespace App\Http\Controllers\JobMap;

use App\Http\Controllers\Controller;
use App\Http\GraphQLClient;
use App\Keyword;
use Illuminate\Http\Request;

class PopularController extends Controller
{
    public function index($letter = null)
    {
        $keywordsL = Keyword::query()
            ->orderBy('name', 'asc')
            ->get()->all();
        
        $newData = array();
        $def = '';
        foreach ($keywordsL as $keyword) {
            $l = strtoupper(substr($keyword['name'], 0, 1));
            if ($l != $def) {
                $newData[] = $l;
                $def = $l;
            }
        }
        
        if ($letter) {
            $itemsByLetter = Keyword::query()
                ->where('name', 'like', $letter . '%')
                ->get()->all();
            
            return view('common.jobmap.explore_popularEmployerKeywords_in_letter', [
                'letters' => $newData,
                'current' => $letter,
                'itemsByLetter' => $itemsByLetter
            ]);
        } else {
            $clientCountries = new GraphQLClient();
            $clientCountries->setParams('locationsKeywords');
            $clientCountries->addResponse([
                'country_code',
                'name'
            ]);
            $keywords = Keyword::query()->limit(15)->get()->all();
            
            return view('common.jobmap.popular', [
                'letters' => $newData,
                'countries' => $clientCountries->request(),
                'keywords' => $keywords
            ]);
        }
        
    }
    
    public function byCountry($country)
    {
        $client = new GraphQLClient();
        $client->setParams('locationsKeywords');
        $client->addRequest([
            'country' => $country
        ]);
        $client->addResponse([
            'country_code',
            'name'
        ]);
    
        $clientKeywords = new GraphQLClient();
        $clientKeywords->setParams('keywordsByLocation');
        $clientKeywords->addRequest([
            'country' => $country
        ]);
        $clientKeywords->addResponse([
            'id',
            'name'
        ]);
        
        return view('common.jobmap.popular_city', [
            'cities' => $client->request(),
            'keywords' => $clientKeywords->request(),
            'country' => $country
        ]);
    }
    
    public function byCity($city, $country)
    {
        $clientKeywords = new GraphQLClient();
        $clientKeywords->setParams('keywordsByLocation');
        $clientKeywords->addRequest([
            'country' => $country,
            'city' => $city
        ]);
        $clientKeywords->addResponse([
            'id',
            'name'
        ]);
        
        return view('common.jobmap.explore_keywords_in_city', [
            'keywords' => $clientKeywords->request(),
            'country' => $country,
            'city' => $city
        ]);
    }
}
