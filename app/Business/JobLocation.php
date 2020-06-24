<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class JobLocation extends Model
{
    protected $table = 'business_job_locations';

    protected $hidden = [
        'google_jobs_notified',
    ];

    protected $casts = [
        'opened_at' => 'date',
    ];

    public $timestamps = false;

    /**
     * Get the job for the location
     */
    public function job()
    {
        return $this->hasOne('App\Business\Job', 'id', 'job_id');
    }

    /**
     * Get the location for the job
     */
    public function location()
    {
        return $this->hasOne('App\Business\Location', 'id', 'location_id');
    }

    /**
     * Localized fields
     */

    public function getLocalizedTitleAttribute() {
        return get_localized_attribute($this, 'title');
    }

    public function getLocalizedDescriptionAttribute() {
        return get_localized_attribute($this, 'description');
    }

    public function getWidgetDataAttribute() {
        return [
            'id' => $this->id,
            'location_id' => $this->location->id,
            'job_id' => $this->job->id,
            'localized_title' => $this->job->localized_title,
            'localized_description' => $this->job->localized_description,

            'category' => $this->job->category ? [
                'localized_name' => $this->job->category->localized_name,
            ] : null,

            'country_code' => $this->location->country_code,

            'address' => str_replace(',', ', ', implode(',', [
                $this->location->street . ' ' . $this->location->street_number,
                $this->location->city,
                $this->location->region,
                $this->location->country,
            ])),

            'career_levels' => $this->job->careerLevels->filter(function ($current_career_level) {
                return $current_career_level->careerLevel;
            })->map(function ($current_career_level) {
                return ['localized_name' => $current_career_level->careerLevel->localized_name];
            }),

            'languages' => $this->job->languages->filter(function ($current_language) {
                return $current_language->language;
            })->map(function ($current_language) {
                return ['name' => $current_language->language->name];
            }),

            'hours' => $this->job->hours,
        ];
    }
}
