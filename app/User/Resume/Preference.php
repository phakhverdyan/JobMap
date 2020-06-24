<?php

namespace App\User\Resume;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_preferences';

    protected $dates = [
        'last_viewed',
    ];

    public $fillable = [
        'looking_job',
        'new_job',
        'new_opportunities',
        'its_urgent',
        'receive_push_notifications',
    ];

    public $transform_yes_no_fields_to_boolean = false;

    public function setLookingJobAttribute($value)
    {
        $this->attributes['looking_job'] = in_array($value, ['yes', '1', 'true', 1, true], true) ? 'yes' : 'no';
    }

    public function setNewJobAttribute($value)
    {
        $this->attributes['new_job'] = in_array($value, ['yes', '1', 'true', 1, true], true) ? 'yes' : 'no';
    }

    public function setNewOpportunitiesAttribute($value)
    {
        $this->attributes['new_opportunities'] = in_array($value, ['yes', '1', 'true', 1, true], true) ? 'yes' : 'no';
    }

    public function setItsUrgentAttribute($value)
    {
        $this->attributes['its_urgent'] = in_array($value, ['yes', '1', 'true', 1, true], true) ? 'yes' : 'no';
    }

    public function setReceivePushNotificationsAttribute($value)
    {
        $this->attributes['receive_push_notifications'] = in_array($value, ['yes', '1', 'true', 1, true], true) ? 'yes' : 'no';
    }

    public function getLookingJobAttribute()
    {
        if ($this->transform_yes_no_fields_to_boolean) {
            return $this->attributes['looking_job'] == 'yes';
        }

        return $this->attributes['looking_job'];
    }

    public function getNewJobAttribute($value)
    {
        if ($this->transform_yes_no_fields_to_boolean) {
            return $this->attributes['new_job'] == 'yes';
        }

        return $this->attributes['new_job'];
    }

    public function getNewOpportunitiesAttribute($value)
    {
        if ($this->transform_yes_no_fields_to_boolean) {
            return $this->attributes['new_opportunities'] == 'yes';
        }

        return $this->attributes['new_opportunities'];
    }

    public function getItsUrgentAttribute($value)
    {
        if ($this->transform_yes_no_fields_to_boolean) {
            return $this->attributes['its_urgent'] == 'yes';
        }

        return $this->attributes['its_urgent'];
    }

    public function getReceivePushNotificationsAttribute($value)
    {
        if ($this->transform_yes_no_fields_to_boolean) {
            return $this->attributes['receive_push_notifications'] == 'yes';
        }

        return $this->attributes['receive_push_notifications'];
    }

    /**
     * Get the user that owns the preference.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function industry()
    {
        return $this->belongsTo('App\Industry','industries');
    }

    public function sub_industry()
    {
        return $this->belongsTo('App\Industry','sub_industries');
    }

    public function category()
    {
        return $this->belongsTo('App\JobCategory','categories');
    }

    public function sub_category()
    {
        return $this->belongsTo('App\JobCategory','sub_categories');
    }
}
