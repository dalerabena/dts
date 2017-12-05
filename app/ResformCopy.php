<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResformCopy extends Model
{
    protected $fillable = [
        'resform_id',
        'filename',
        'path'
    ];
}
