<?php

namespace App\User\Resume;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_educations';
    
    /**
     * Get the user that owns the availability.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function _degree()
    {
        return $this->belongsTo('App\User\Resume\Autocomplete\Degree', 'degree_id');
    }

    public function _study()
    {
        return $this->belongsTo('App\User\Resume\Autocomplete\FieldOfStudy', 'study_id');
    }

    public function _grade()
    {
        return $this->belongsTo('App\User\Resume\Autocomplete\Grade', 'grade_id');
    }
}
