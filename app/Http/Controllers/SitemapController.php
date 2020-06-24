<?php

namespace App\Http\Controllers;

use App\Business;
use App\Business\Job;
use App\Business\Location;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sitemap()
    {
        $sitemap = \App::make('sitemap');

        $sitemap->add(url('/'), null, '1.0', 'daily');

        Business::orderBy('updated_at', 'desc')->get()->each(function($business) use (&$sitemap) {
            $sitemap->add(
                url('business/view/' . $business->getKey() . '/' . $business->slug),
                $business->updated_at,
                '0.8',
                'weekly'
            );
        });

        Job::orderBy('updated_at', 'desc')->get()->each(function($job) use (&$sitemap) {
            $sitemap->add(
                url('map/view/job/' . $job->getKey()),
                $job->updated_at,
                '1.0',
                'weekly'
            );
        });

        Location::orderBy('updated_at', 'desc')->get()->each(function($location) use (&$sitemap) {
            $sitemap->add(
                url('map/view/location/' . $location->getKey() . '/' . str_slug($location->name)),
                $location->updated_at,
                '0.8',
                'weekly'
            );
        });

        return $sitemap->render('xml');
    }
}
