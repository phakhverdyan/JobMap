<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    public function chat() {
        return $this->belongsTo('App\Chat');
    }

    public function interlocutor() {
        return $this->belongsTo('App\ChatInterlocutor');
    }

    public function member() {
        return $this->belongsTo('App\ChatMember');
    }

    public function read_interlocutors() {
        return $this->hasMany('App\ChatInterlocutor', 'last_read_message_id', 'id');
    }

    public function interview_request() {
    	return $this->belongsTo('App\InterviewRequest');
    }
}