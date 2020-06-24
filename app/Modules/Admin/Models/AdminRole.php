<?php

namespace App\Modules\Admin\Models;

use Zizaco\Entrust\EntrustRole;

class AdminRole extends EntrustRole
{

//    public function __construct(array $attributes = [])
//    {
//        print_r(get_object_vars($this),1);
//        parent::__construct($attributes);
//    }

    protected $table = 'roles';

}
