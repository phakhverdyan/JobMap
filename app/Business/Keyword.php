<?php

namespace App\Business;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_keywords';
    
    public $timestamps = false;
    
    public function business()
    {
        return $this->belongsTo('App\Business');
    }
    
    public function keyword()
    {
        return $this->hasOne('App\Keyword', 'id', 'keyword_id');
    }
}
