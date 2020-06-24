<?php

namespace App\User\Resume;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_skills';
    
    /**
     * Get the user that owns the preference.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function _skill()
    {
        return $this->belongsTo('App\User\Resume\Autocomplete\Skill', 'title_id');
    }
}
