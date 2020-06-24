<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $appends = [
        'name',
    ];

    protected $hidden = [
        'relevant_translation',
        'translations',
        'native_name',
        'alpha3_code',
        'calling_codes',
        'top_level_domains',
        'capital',
        'alt_spellings',
        'region',
        'subregion',
        'population',
        'latitude',
        'longitude',
        'demonym',
        'area',
        'gini',
        'timezones',
        'borders',
        'numeric_code',
        'currencies',
        'languages',
        'cioc',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'top_level_domains' 	=> 'array',
        'calling_codes' 		=> 'array',
        'alt_spellings' 		=> 'array',
        'timezones' 			=> 'array',
        'borders' 				=> 'array',
        'currencies' 			=> 'array',
        'languages' 			=> 'array',
    ];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    // ---------------------------------------------------------------------- //
    //
    // - Attribute Methods
    //
    // ---------------------------------------------------------------------- //

    public function getNameAttribute()
    {
        return get_localized_attribute_2_0($this, 'name');
    }

    public function getShortNameAttribute()
    {
        return get_localized_attribute_2_0($this, 'short_name');
    }

    // ---------------------------------------------------------------------- //
    //
    // - Relation Methods
    //
    // ---------------------------------------------------------------------- //

    public function translations()
    {
        return $this->hasMany(CountryTranslation::class, 'country_code', 'alpha2_code');
    }

    public function relevant_translation()
    {
        return $this->hasOne(CountryTranslation::class, 'country_code', 'alpha2_code')->where('locale', app()->getLocale());
    }
}
