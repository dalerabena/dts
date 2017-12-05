<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdformCopy extends Model
{
    protected $fillable = [
        'ordform_id',
        'filename',
        'path'
    ];
}
