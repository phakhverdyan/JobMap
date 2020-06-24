<?php

namespace App;
//use Laravel\Cashier\Billable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Business extends Model
{
	protected $dates = [
		'first_plan_payment_was_at',
		'last_plan_payment_was_at',
	];

	public $appends = [
		'image_url',
		'middle_image_url',
		'large_image_url',
		'realtime_token',
		'localized_name',
		'localized_description',
		'localized_keywords',
		'localized_website',
		'localized_facebook',
		'localized_instagram',
		'localized_twitter',
		'localized_youtube',
		'localized_snapchat',
		'localized_video',
	];

	public $hidden = [
		'realtime_token',
		'next_plan_id',
		'next_plan_type',
		'payment_day',
		'cancel_plan_phone',
		'first_plan_payment_was_at',
		'last_plan_payment_was_at',
	];

	public $casts = [
		'last_seen_at' => 'datetime',
	];

	/**
	 * Get the administrator for the business
	 */
	public function admin()
	{
		return $this->hasOne('App\Business\Administrator');
	}

	public function admins()
	{
		return $this->hasMany('App\Business\Administrator');
	}

	public function language() {
		return $this->belongsTo('App\Language', 'language_prefix', 'prefix');
	}

	// public function languages(){
	//     return $this->hasMany('App\Business\Language')->where('status', 0);
	// }

	// public function languagesList(){
	//     return $this->hasMany('App\Business\Language');
	// }

	public function atsList()
	{
		return $this->hasMany('App\Business\Import');
	}

	public function billingAddress()
	{
		return $this->hasOne('App\Business\BillingAddress');
	}

	/**
	 * Get the industry for the business
	 */
	public function industry()
	{
		return $this->hasOne('App\Industry', 'id', 'industry_id');
	}

	/**
	 * Get the industries for the business
	 */
	public function industries()
	{
		return $this->belongsToMany('App\Industry');
	}

	/**
	 * Get the locations for the business
	 */
	public function locations()
	{
		return $this->hasMany('App\Business\Location');
	}

	/**
	 * Get the locations for the business
	 */
	public function cards()
	{
		return $this->hasMany('App\Business\Card');
	}

	/**
	 * Get the departments for the business
	 */
	public function departments()
	{
		return $this->hasMany('App\Business\Department');
	}

	/**
	 * Get the keywords for the business
	 */
	public function keywords()
	{
		return $this->hasMany('App\Business\Keyword')
			->join('keywords', 'keywords.id', '=', 'business_keywords.keyword_id')
			->where('keywords.language_prefix', 'en');
	}

	/**
	 * Get the keywords FR for the business
	 */
	public function keywords_fr()
	{
		return $this->hasMany('App\Business\Keyword')
			->join('keywords', 'keywords.id', '=', 'business_keywords.keyword_id')
			->where('keywords.language_prefix', 'fr');
	}

	public function jobs()
	{
		return $this->hasMany('App\Business\Job');//->where('business_jobs.status', '=', 1);
	}

	public function images()
	{
		return $this->hasMany('App\Business\Image');
	}

	public function brands()
	{
		return $this->hasMany('App\Business','parent_id', 'id');
	}

	public function indeed_account()
	{
		return $this->hasOne('App\IndeedAccount');
	}

	// ---------------------------------------------------------------------- //
	// 
	// - Different Attributes
	// 
	// ---------------------------------------------------------------------- //

	public function getPictureAttribute()
	{
		if (!$this->attributes['picture']) {
			return null;
		}
		
		$filename = pathinfo($this->attributes['picture'], PATHINFO_FILENAME);
		
		return $filename . '.png';
	}

	public function getImageUrlAttribute()
	{
		$prefix = '100.100.';

		if ($this->picture) {
			$picture_path = storage_path('app/business/' . $this->id . '/logo/' . $prefix . $this->attributes['picture']);

			if (!file_exists($picture_path)) {
				return Storage::disk('business')->url($this->id . '/' . $prefix) . $this->picture . '?nofile&' . time();
			}

			return Storage::disk('business')->url($this->id . '/' . $prefix) . $this->picture . '?' . filemtime($picture_path);
		}

		return asset('img/business-logo-small.png');
	}

	public function getMiddleImageUrlAttribute()
	{
		$prefix = '200.200.';

		if ($this->picture) {
			return Storage::disk('business')->url($this->id . '/' . $prefix) . $this->picture;
		}

		return asset('img/business-logo-small.png');
	}

	public function getLargeImageUrlAttribute()
	{
		$prefix = '500.500.';
		
		if ($this->picture) {
			return Storage::disk('business')->url($this->id . '/' . $prefix) . $this->picture;
		}

		return asset('img/business-logo-small.png');
	}

	public function getRealtimeTokenAttribute()
	{
		return hash_hmac('sha256', $this->id, 'Bobik-realtime-Business-token');
	}

	// ---------------------------------------------------------------------- //
	// 
	// - Localized attributes
	// 
	// ---------------------------------------------------------------------- //

	public function getLocalizedNameAttribute() {
		return get_localized_attribute($this, 'name');
	}

	public function getLocalizedDescriptionAttribute() {
		return get_localized_attribute($this, 'description');
	}

	public function getLocalizedKeywordsAttribute() {
		return get_localized_attribute($this, 'keywords');
	}

	public function getLocalizedWebsiteAttribute() {
		return get_localized_attribute($this, 'website');
	}

	public function getLocalizedFacebookAttribute() {
		return get_localized_attribute($this, 'facebook');
	}

	public function getLocalizedInstagramAttribute() {
		return get_localized_attribute($this, 'instagram');
	}

	public function getLocalizedTwitterAttribute() {
		return get_localized_attribute($this, 'twitter');
	}

	public function getLocalizedYoutubeAttribute() {
		return get_localized_attribute($this, 'youtube');
	}

	public function getLocalizedSnapchatAttribute() {
		return get_localized_attribute($this, 'snapchat');
	}

	public function getLocalizedVideoAttribute() {
		return get_localized_attribute($this, 'video');
	}

	// ---------------------------------------------------------------------- //

	public static function boot() {
		parent::boot();

		static::deleting(function ($business) {
			$business->admins()->get()->each(function ($business_admin) {
				$business_admin->delete();
			});

			$business->atsList()->get()->each(function ($ats_list_item) {
				$ats_list_item->delete();
			});

			$business->billingAddress()->get()->each(function ($billing_address) {
				$billing_address->delete();
			});

			$business->locations()->get()->each(function ($location) {
				$location->delete();
			});

			$business->cards()->get()->each(function ($card) {
				$card->delete();
			});

			$business->departments()->get()->each(function ($department) {
				$department->delete();
			});

			$business->keywords()->get()->each(function ($keyword) {
				$keyword->delete();
			});

			$business->keywords_fr()->get()->each(function ($keyword) {
				$keyword->delete();
			});

			$business->jobs()->get()->each(function ($job) {
				$job->delete();
			});

			$business->images()->get()->each(function ($image) {
				$image->delete();
			});

			$business->brands()->get()->each(function ($brand) {
				$brand->delete();
			});
		});
	}
}
