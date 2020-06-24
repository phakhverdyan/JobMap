<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMember extends Model
{
    public function chat() {
        return $this->belongsTo('App\Chat');
    }

    public function business() {
        return $this->belongsTo('App\Business');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function manager() {
        return $this->belongsTo('App\User');
    }
}
