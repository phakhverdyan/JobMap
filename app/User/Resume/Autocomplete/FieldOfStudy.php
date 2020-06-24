<?php

namespace App\User\Resume\Autocomplete;

use Illuminate\Database\Eloquent\Model;

class FieldOfStudy extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fields_of_study';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'title_fr',
    ];

}
