<?php

namespace App\User\Resume\Autocomplete;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'skills';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'title_fr',
    ];

}
