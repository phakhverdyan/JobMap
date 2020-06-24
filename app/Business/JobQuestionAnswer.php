<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class JobQuestionAnswer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'job_question_answers';

    protected $fillable = [
        'answer',
        'question_id',
        'user_id',
    ];

    public function question()
    {
        return $this->hasOne('App\Business\JobQuestion', 'id', 'question_id');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
