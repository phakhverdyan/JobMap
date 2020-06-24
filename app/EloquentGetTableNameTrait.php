<?php
/**
 * Created by PhpStorm.
 * User: denispetrusha
 * Date: 14.01.2018
 * Time: 15:45
 */

namespace App;

trait EloquentGetTableNameTrait
{
    
    public static function getTableName()
    {
        return ((new self)->getTable());
    }
    
}