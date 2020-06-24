<?php

namespace App\Modules\Admin\Models;

use Zizaco\Entrust\EntrustPermission;

class AdminPermission extends EntrustPermission
{

    protected $table = 'permissions';

}
