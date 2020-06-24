<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_languages';
    
    public function lang(){
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }
}
