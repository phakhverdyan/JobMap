<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function adminUser()
    {
        return $this->belongsToMany('App\Modules\Admin\Models\AdminUser', 'admin_user_department');
    }
}
