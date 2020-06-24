<?php

namespace App\Modules\Admin\Models;

use App\Business;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'client_id', 'business_id', 'department_id','admin_user_id', 'status', 'title', 'priority'
    ];

    public function ticketMessages()
    {
        return $this->hasMany(TicketMessage::class)->orderByDesc('created_at');
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function admin_user()
    {
        return $this->belongsTo(AdminUser::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class);
    }
}
