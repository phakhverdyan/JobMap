<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QRCodeSetting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'qr_code_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id",
        "business_id",
        "name",
        "out_eye",
        "inner_eye",
        "single",
        "background",
        "logo_data",
    ];
}
