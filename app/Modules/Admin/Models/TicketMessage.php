<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketMessage extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'ticket_id', 'agent_id', 'client_id', 'text', 'type'
    ];

    public function admin_user()
    {
        return $this->belongsTo(AdminUser::class, 'agent_id');
    }


}
