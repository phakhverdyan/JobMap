<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
     protected $fillable = [
         'name',
         'code',
         'off_an_plans_value',
         'off_an_plans_type',
//         'off_on_seats_value',
//         'off_on_seats_type',
         'off_on_month_value',
         'off_on_month_type',
         'duration_value',
         'duration_type',
         'status'
     ];
}
