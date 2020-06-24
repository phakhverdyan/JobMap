<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'business_jobs';

    protected $appends = [
        'localized_title',
        'localized_description',
        'localized_notes',
    ];

    /**
     * Get the administrator for the business
     */
    public function admin()
    {
        return $this->hasMany('App\Business\Administrator', 'business_id', 'business_id');
    }

    /**
     * Get the user for the manager
     */
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function location()
    {
        return $this->hasOne('App\Business\Location', 'id', 'location_id');
    }

    /**
     * Get the locations for the job (only opened)
     */
    public function locations()
    {
        return $this->hasMany('App\Business\JobLocation')->where('business_job_locations.status', '=', 1);
    }

    /**
     * Get the locations(all) for the job
     */
    public function locationsAll()
    {
        return $this->hasMany('App\Business\JobLocation');
    }

    public function _locations()
    {
        return $this->belongsToMany('App\Business\Location', 'business_job_locations', 'location_id', 'job_id')->withPivot('status')->where('business_job_locations.status', '=', 1);
    }
    public function _closedLocations()
    {
        return $this->belongsToMany('App\Business\Location', 'business_job_locations', 'location_id', 'job_id')->withPivot('status')->where('business_job_locations.status', '=', 1);
    }
    public function _locationsAll()
    {
        return $this->belongsToMany('App\Business\Location', 'business_job_locations', 'job_id', 'location_id')->withPivot('status');
    }

    /**
     * Get the types for the job
     */
    public function types()
    {
        return $this->hasMany('App\Business\JobType');
    }

    /**
     * Get the type for the job
     */
    public function type()
    {
        return $this->hasOne('App\JobType', 'key', 'type_key');
    }

    /**
     * Get the career levels for the job
     */
    public function careerLevels()
    {
        return $this->hasMany('App\Business\JobCareerLevel');
    }

    /**
     * Get the departments for the job
     */
    public function departments()
    {
        return $this->hasMany('App\Business\JobDepartment');
    }

    /**
     * Get the certificates for the job
     */
    public function certificates()
    {
        return $this->hasMany('App\Business\JobCertificate');
    }

    /**
     * Get the keywords for the job
     */
    public function keywords()
    {
        return $this->hasMany('App\Business\JobKeyword')->join('keywords', 'keywords.id', '=', 'business_job_keywords.keyword_id')
            ->where('keywords.language_prefix', 'en');
    }

    /**
     * Get the keywords for the job
     */
    public function keywords_fr()
    {
        return $this->hasMany('App\Business\JobKeyword')->join('keywords', 'keywords.id', '=', 'business_job_keywords.keyword_id')
            ->where('keywords.language_prefix', 'fr');
    }

    /**
     * Get the languages for the job
     */
    public function languages()
    {
        return $this->hasMany('App\Business\JobLanguage');
    }

    /**
     * Get the business for the user
     */
    public function business()
    {
        return $this->belongsTo('App\Business');
    }

    /**
     * Get the category for the job
     */
    public function category()
    {
        return $this->belongsTo('App\JobCategory');
    }

    /**
     * Get the questions for the job
     */
    public function questions()
    {
        return $this->hasMany('App\Business\JobQuestion');
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

    public function getLocalizedNotesAttribute() {
        return get_localized_attribute($this, 'description');
    }

    // ---------------------------------------------------------------------- //

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($job) {
            $job->locations()->get()->each(function ($job_location) {
                $job_location->delete();
            });

            $job->careerLevels()->get()->each(function ($career_level) {
                $career_level->delete();
            });

            $job->departments()->get()->each(function ($department) {
                $department->delete();
            });

            $job->certificates()->get()->each(function ($certificate) {
                $certificate->delete();
            });

            $job->keywords()->get()->each(function ($keyword) {
                $keyword->delete();
            });

            $job->keywords_fr()->get()->each(function ($keyword) {
                $keyword->delete();
            });

            $job->languages()->get()->each(function ($language) {
                $language->delete();
            });
        });
    }
}
