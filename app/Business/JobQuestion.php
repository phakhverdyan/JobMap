<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class JobQuestion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'job_questions';

    protected $fillable = [
        'question',
        'question_fr',
        'type',
        'job_id',
    ];

    public function job()
    {
        return $this->hasOne('App\Business\Job', 'id', 'job_id');
    }

    public function answers()
    {
        return $this->hasMany('App\Business\JobQuestionAnswer','question_id', 'id');
        //return $this->belongsTo('App\Business\JobQuestionAnswer', 'id', );
    }

    public function getLocalizedQuestionAttribute() {
        return get_localized_attribute($this, 'question');
    }
}
