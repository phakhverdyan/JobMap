<?php

namespace App\User\Resume;

use Illuminate\Database\Eloquent\Model;

class BasicInfo extends Model
{
    protected $table = 'user_basic_infos';
    
    public $appends = [
        'localized_about',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getLocalizedAboutAttribute()
    {
        return get_localized_attribute($this, 'about');
    }
}
