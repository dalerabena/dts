<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefBrgy extends Model
{
    protected $table = 'refbrgy';
    protected $fillable = [
        'brgyCode',
        'brgyDesc'
    ];
}
