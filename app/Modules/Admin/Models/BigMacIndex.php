<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class BigMacIndex extends Model
{
    protected $table = 'big_mac_indexes';

    protected $fillable = [
        'flag',
        'country_code',
        'country_name',
        'coefficient'
    ];
}
