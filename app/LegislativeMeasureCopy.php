<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LegislativeMeasureCopy extends Model
{
    protected $fillable = [
        'legislative_measure_id',
        'filename',
        'path',
        'type'
    ];
}
