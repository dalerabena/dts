<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = [
        'document_id',
        'assigned_to',
        'forwarded_to',
        'comment',
        'status',
        'opened_by',
        'closed_by'
    ];
}
