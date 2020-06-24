<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_images';

    protected $fillable = [
        'business_id',
        'bg_picture',
        'number',
    ];

}
