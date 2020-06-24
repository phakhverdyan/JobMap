<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Chat extends Model
{
    use EloquentGetTableNameTrait;
    use Notifiable;

    public function messages() {
        return $this->hasMany('App\ChatMessage');
    }

    public function members() {
        return $this->hasMany('App\ChatMember');
    }

    public function interlocutors() {
        return $this->hasMany('App\ChatInterlocutor');
    }

    public function last_message() {
        return $this->belongsTo('App\ChatMessage', 'last_message_id');
    }
}
