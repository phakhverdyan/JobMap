<?php

namespace App\User\Resume\Autocomplete;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'interests';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'title_fr',
    ];

}
