<?php

namespace App\User\Resume\Autocomplete;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'degrees';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'title_fr',
    ];

}
