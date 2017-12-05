<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Franform extends Model
{
    protected $fillable = [
        'ordinance_no',
        'name',
        'barangay',
        'status',
        'units',
        'motor_type',
        'motor_no',
        'chassis_no',
        'sidecar_no',
        'approved_date'
    ];
}
