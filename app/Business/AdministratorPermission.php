<?php

namespace App\Business;

use App\EloquentGetTableNameTrait;
use Illuminate\Database\Eloquent\Model;

class AdministratorPermission extends Model
{
    use EloquentGetTableNameTrait;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_administrator_permissions';
    
    public $timestamps = false;
    
}
