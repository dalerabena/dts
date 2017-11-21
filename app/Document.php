<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'reference_number',
        'subject',
        'detail',
        'priority',
        'department',
        'initiator',
        'comment',
        'attachment'
    ];
}
