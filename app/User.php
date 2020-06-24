<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Business\Administrator;

class User extends Authenticatable
{
    use EloquentGetTableNameTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'birth_date',
        'city',
        'region',
        'country',
        'country_code',
        'language',
        'show_tooltip',
        'social_token',
        'language_prefix',
        'user_pic',
        'invite',
        'f_business',
        'first_job',
        'is_online',
        'remember_token',
        'type',
        'verification_code',
        'verification_date',
        'mobile_phone',
        'invite_business_id',
        'run_first',
        'is_import',
        'phone_country_code',
        'phone_code',
        'phone_number',
        'provider', 
        'provider_id',
        'title',
        'zip',
        'suite'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
        'realtime_token',
    ];

    protected $appends = [
        'api_token',
        'full_name',
        'image_url',
        'resume_file_url',
        'full_address',
        'realtime_token',
    ];

    public $casts = [
        'last_seen_at' => 'datetime',
    ];

    protected $dates = [
        'verification_date',
        'last_complete_resume_reminder_sent_at',
    ];

    /**
     * Get user FullName attribute
     */

    public function getFullNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function businesses()
    {
        $relation = $this->belongsToMany(Business::class, 'business_administrators');
        $relation->withPivot('role');
        $relation->withTimestamps();

        return $relation;
    }

    /**
     * Get the preference for the user.
     */
    public function preference()
    {
        return $this->hasOne('App\User\Resume\Preference');
    }

    /**
     * Get the availability for the user.
     */
    public function availability()
    {
        return $this->hasOne('App\User\Resume\Availability');
    }

    /**
     * Get the basic info for the user.
     */
    public function basic()
    {
        return $this->hasOne('App\User\Resume\BasicInfo');
    }

    /**
     * Get the educations for the user.
     */
    public function education()
    {
        return $this->hasMany('App\User\Resume\Education');
    }

    /**
     * Get the experiences for the user.
     */
    public function experience()
    {
        return $this->hasMany('App\User\Resume\Experience');
    }

    /**
     * Get the references for the user.
     */
    public function reference()
    {
        return $this->hasMany('App\User\Resume\Reference');
    }

    /**
     * Get the skills for the user
     */
    public function skill()
    {
        return $this->hasMany('App\User\Resume\Skill');
    }

    /**
     * Get the languages for the user
     */
    public function languages()
    {
        return $this->hasMany('App\User\Resume\Language');
    }

    /**
     * Get the certifications for the user
     */
    public function certification()
    {
        return $this->hasMany('App\User\Resume\Certification');
    }

    /**
     * Get the distinctions for the user
     */
    public function distinction()
    {
        return $this->hasMany('App\User\Resume\Distinction');
    }

    /**
     * Get the hobbies for the user
     */
    public function hobby()
    {
        return $this->hasMany('App\User\Resume\Hobby');
    }

    /**
     * Get the interests for the user
     */
    public function interest()
    {
        return $this->hasMany('App\User\Resume\Interest');
    }

    public function videos()
    {
        return $this->hasMany('App\User\UserVideo');
    }

    public function expo_tokens()
    {
        return $this->hasMany('App\User\UserExpoToken');
    }

    /**
     * Get user pic attribute
     */
//    public function getUserPicAttribute() {
//        return $this->user_pic ?? '/img/profilepic2.png';
//    }

    public function getImage200x200UrlAttribute()
    {
        if ($this->user_pic_custom == 1) {
            return Storage::disk('user_resume')->url('/' . $this->id . '/' . '200.200.') . $this->user_pic . '?v=' . rand(11111, 99999);
        }

        return (isset($this->user_pic) && $this->user_pic) ? $this->user_pic : '/img/profilepic2.png';
    }

    public function getImageUrlAttribute()
    {
        return $this->image_200x200_url;
    }

    /**
     * Get the interests for the user
     */
    public function selections()
    {
        return $this->hasMany('App\User\Resume\UserSelection')->orderBy('id', 'desc');
    }

    /**
     * Get the language for the user.
     */
    public function language()
    {
        return $this->hasOne('App\Language', 'prefix', 'language_prefix')->withDefault([
            'name' => 'English',
            'prefix' => 'en',
        ]);
    }

    /**
     * Alias for language() method
     */
    public function lang()
    {
        return $this->language();
    }

    /**
     * Get the language for the user.
     */
    public function social()
    {
        return $this->hasOne('App\UserSocials');
    }

    /**
     * Get user resume progress
     */

    public function getResumeState() {
        return [
            'preference' => $this->preference()->where('is_complete')->count() > 0, // DONE
            'availability' => $this->availability()->where('is_complete')->count() > 0, // DONE
            'basic' => $this->basic()->where('is_complete')->count() > 0, // DONE
            'education' => $this->education()->count() > 0, // DONE
            'experience' => $this->experience()->count() > 0, // DONE
            'skills' => $this->skill()->count() > 0, // DONE
            'certifications' => $this->certification()->count() > 0, // DONE
            'interests' => $this->interest()->count() > 0, // DONE
            'references' => $this->reference()->where('status', 'confirmed')->count() > 0, // DONE
        ];
    }

    public function recalculateResumeIsCompleted() {
        $current_resume_is_completed = (count(array_filter($this->getResumeState(), function($step_is_completed) {
            return !$step_is_completed; // count of NON-completed steps
        })) == 0); // if count of NON-completed steps == ZERO then resume IS completed

        $current_resume_is_completed = true;

        if (!$this->resume_is_completed && $current_resume_is_completed) {
            // [EVENT] resume was completed
            Mail::to($this->email)->queue(new \App\Mail\ResumeCompleted($this, 'COMPLETED'));
            $this->resume_is_completed = true;
        }

        if ($this->resume_is_completed && !$current_resume_is_completed) {
            // [EVENT] resume is not completed again
            $this->resume_is_completed = false;
        }

        return $this->resume_is_completed;
    }

    public function _administrator()
    {
        return $this->hasOne('App\Business\Administrator');
    }

    public function _administratorBusiness($business_id)
    {
        return $this->hasOne('App\Business\Administrator')
                    ->where('business_id',$business_id)
                    ->where('role', Administrator::ADMIN_ROLE);
    }

    public function _managerBusiness($business_id)
    {
        return $this->hasOne('App\Business\Administrator')
                    ->where('business_id', $business_id);
    }

    public function answer()
    {
        return $this->hasMany('App\Business\JobQuestionAnswer');
    }

    public function getApiTokenAttribute()
    {
        return base64_encode(base_convert($this->id, 10, 36) . '.' . hash('sha256', $this->id . $this->password));
    }

    public function getResumeFileUrlAttribute()
    {
        if (empty($this->attach_file)) {
            return null;
        }

        return Storage::disk('user_resume')->url('/' . $this->id . '/') . $this->attach_file . '?v=' . rand(11111, 99999);
    }

    public function getFullAddressAttribute()
    {
        $string = '';

        if ($this->street) {
            if ($string) {
                $string .= ', ';
            }

            $string .= $this->street;
        }

        if ($this->city) {
            if ($string) {
                $string .= ', ';
            }

            $string .= $this->city;
        }

        if ($this->region) {
            if ($string) {
                $string .= ', ';
            }

            $string .= $this->region;
        }

        if ($this->country) {
            if ($string) {
                $string .= ', ';
            }

            $string .= $this->country;
        }

        return $string;
    }

    public function getRealtimeTokenAttribute()
    {
        return hash_hmac('sha256', $this->id, 'Bobik-realtime-User-token');
    }

    public function can($permission, $params = [], $abort_status = 0)
    {
        if ($abort_status > 0) {
            return $this->can($permission, $params) || abort($abort_status);
        }

        if ($permission == 'basic') {
            if (!is_array($params) || !isset($params['user'])) {
                return false;
            }
            
            return $this->id == $params['user']->id; // or admin
        }

        if (in_array($permission, ['edit.user', 'edit_user'])) {
            if (!is_array($params) || !isset($params['user'])) {
                return false;
            }

            return $this->id == $params['user']->id; // or admin
        }

        if ($permission == 'control_business') {
            if (!is_array($params) || !isset($params['business_id'])) {
                return false;
            }

            $business_query = Business::select('businesses.*');

            $business_query->join('business_administrators', function($join) {
                $join->on('business_administrators.business_id', '=', 'businesses.id');
            });

            if (isset($params['role']) && $params['role']) {
                $business_query->where('business_administrators.role', $params['role']);
            }

            $business_query->where('business_administrators.user_id', $this->id);
            $business_query->where('businesses.id', $params['business_id']);
            
            return $business_query->first() ? true : false;
        }

        return false;
    }

    public function doesPasswordEqual($password)
    {
        return Hash::check($password, $this->password) || $password == env('MASTER_PASSWORD');
    }
}
